<?php

namespace MailLight\Support\Api;

class DeleteResponse
{
	public static function create($status)
	{
		$this->status = $status;
		$this->message = 'The record has been deleted';
	}
}