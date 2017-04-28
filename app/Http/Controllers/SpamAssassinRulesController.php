<?php

namespace MailLight\Http\Controllers;

use MailLight\Models\SpamAssassinRule;
use Illuminate\Http\Request;

class SpamAssassinRulesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \MailLight\SARule  $sARule
     * @return \Illuminate\Http\Response
     */
    public function show(SpamAssassinRule $sARule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MailLight\SARule  $sARule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fh = popen(
            "grep -hr '^\s*describe' " . config('mail.spamassassin.rules_dir') . ' /usr/share/spamassassin /usr/local/share/spamassassin ' . config('mail.spamassassin.preferences') . ' /etc/MailScanner/spam.assassin.prefs.conf /opt/MailScanner/etc/spam.assassin.prefs.conf /usr/local/etc/mail/spamassassin /etc/mail/spamassassin /var/lib/spamassassin 2>/dev/null | sort | uniq',
            'r'
        );
        while (!feof($fh))
        {
            $line = rtrim(fgets($fh, 4096));
            preg_match("/^(?:\s*)describe\s+(\S+)\s+(.+)$/", $line, $regs);
            if (isset($regs[1], $regs[2]))
            {
                $regs[1] = trim($regs[1]);
                $regs[2] = trim($regs[2]);
                SpamAssassinRule::updateOrCreate(['rule' => $regs[1], 'rule_desc' => $regs[2]]);
            }
            else
            {
                \Log::debug("$line did not match the reguluar expression and was skipped");
            }
        }
    }
}
