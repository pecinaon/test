<?php
namespace App;


use Nette\Security\IIdentity;

class Identity implements IIdentity
{
	public $name;

	public $id;

	/**
	 * Identity constructor.
	 */
	public function __construct($row)
	{
		$this->name = $row->name;
		$this->id = $row->name;
	}

	/**
	 * Returns the ID of user.
	 * @return mixed
	 */
	function getId()
	{
		return $this->id;
	}

	/**
	 * Returns a list of roles that the user is a member of.
	 * @return array
	 */
	function getRoles()
	{
		return array("ADMIN");
	}
}