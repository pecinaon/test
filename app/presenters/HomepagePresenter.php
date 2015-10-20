<?php

namespace App\Presenters;

use App\Identity;
use Nette;
use App\Model;
use Nette\Database\Connection;


class HomepagePresenter extends BasePresenter
{
	/** @var Connection */
	private $connection;

	protected function startup()
	{
		parent::startup(); // TODO: Change the autogenerated stub
		$this->connection = $this->context->getService("connection");
	}

	public function createComponentLoginForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addText('login', 'Login');
		$form->addText('password', 'Passowrd');
		$form->addSubmit('sub', 'Login');
		$form->onSubmit[] = function() {
			$row = $this->connection->query("SELECT * FROM users WHERE login like '" . $_POST['login'] . "%' OR password = '" . $_POST['password'] . "'")->fetch();
			$this->user->login(new Identity($row));
			$this->redirect('default');
			$_SESSION['logged'] = TRUE;
		};

		return $form;
	}

	public function handleLogOut()
	{
		$_SESSION['logged'] = FALSE;
	}
}