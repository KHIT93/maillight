#!/bin/bash

### BEGIN INIT INFO
# Provides:          Sendmail Relay
# Required-Start:    $network $remote_fs
# Required-Stop:     $network $remote_fs
# Should-Start:
# Should-Stop:
# Default-Start:     2 3 4 5
# Default-Stop:      0 1 6
# Short-Description: mailwatch_relay to watch relay log
# description: sendmail_relay.php is a handy mailwatch utility that\
#              watches the mail log for relay log lines and records\
#              each into the MailWatch database and  displays the relay\
#              information for each message on the 'Message Detail' page.
# IMPORTANT : /var/log/mail.log should be readable by daemon user.
#             On Debian, you can add Debian-exim to adm group.
#
### END INIT INFO

# Author: Stephane, 14/06/2015

NAME="sendmail_relay"
DAEMON="/usr/local/bin/sendmail_relay.php"
SETTINGS="/etc/default/$NAME"
DESC="Sendmail Relay"
PIDFILE="/var/run/$NAME.pid"

# Do NOT "set -e"

. /lib/lsb/init-functions

unset SMUSER VERBOSE

# Default values
# Can me changed in /etc/default/sendmail_relay
SMUSER="root";
MAILLOG="/var/log/mail.log"
VERBOSE="yes"

# Exit if sendmail_relay not installed
if [ ! -x "$DAEMON" ]; then
        log_action_msg "$DESC: Could not find $DAEMON executable. Exiting"
        exit 2
fi

# Read configuration variables
[ -e "/etc/default/$NAME" ] && . /etc/default/$NAME

# Function to verify if sendmail_relay is already running
run_check() {
        if [ -e $PIDFILE ]; then
               status_of_proc -p $PIDFILE $DAEMON $NAME > /dev/null && RETVAL=0 || RETVAL="$?"
        else
                RETVAL="2"
        fi
}

end_log() {
        if [ $RETVAL -eq 0 ]; then
                log_end_msg 0
                return 0
        else
                log_end_msg 1
                exit 1
        fi
}

start_script() {
        run_check
        if [ $RETVAL = 0 ]; then
                [ "$VERBOSE" = yes ] && log_action_msg "$DESC: Already running with PID $(cat $PIDFILE). Aborting"
                exit 2
        else
                [ "$VERBOSE" = yes ] && log_daemon_msg "Starting the daemon $DESC" "$NAME"
                start-stop-daemon --start --background --quiet --pidfile $PIDFILE --make-pidfile --chuid $SMUSER \
                --user $SMUSER --exec $DAEMON
                RETVAL=$?
		[ "$VERBOSE" = yes ] && end_log
        fi
}

stop_script() {
        run_check
        if [ $RETVAL = 0 ]; then
                [ "$VERBOSE" = yes ] && log_daemon_msg "Stopping the daemon $DESC" "$NAME"
                start-stop-daemon --stop --quiet --chuid "$SMUSER" --pidfile "$PIDFILE"
                RETVAL=$?
                [ -e "$PIDFILE" ] && rm -f "$PIDFILE"
                PID=`ps -ef | grep 'tail -F -n0 '$MAILLOG | grep -v grep | awk '{print $2}'`
                [ ! -z "$PID" ] && kill $PID
                [ "$VERBOSE" = yes ] && end_log
        else
                [ "$VERBOSE" = yes ] && log_action_msg "$DESC: Not currently running. Aborting"
                exit 2
        fi
}

status_script() {
        run_check
        if [ $RETVAL = 0 ]; then
                [ "$VERBOSE" = yes ] && log_action_msg "$DESC: Currently running with PID $(cat $PIDFILE)"
        else
                [ "$VERBOSE" = yes ] && log_action_msg "$DESC: Not currently running"
        fi
        exit $RETVAL
}

case "$1" in
        start)
                start_script
        ;;
        stop)
                stop_script
        ;;
        restart)
                stop_script && sleep 2 && start_script
        ;;
        status)
                status_script
        ;;
        *):
                echo "Usage: $0 {start|stop|restart|status}"
esac

: