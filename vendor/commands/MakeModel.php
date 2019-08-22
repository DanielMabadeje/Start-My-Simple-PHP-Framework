<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends Command
{
    protected $commandName = 'make:model';
    protected $commandDescription = "Creates a new model";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "What Model do you want to create?";

    protected $commandOptionName = "m"; // should be specified like "app:greet John --cap"
    // protected $commandOptionName = $input->getOption();
    protected $commandOptionDescription = 'If set, it will set the directory for model class to be created';

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            )
            ->addOption(
                $this->commandOptionName,
                null,
                InputOption::VALUE_NONE,
                $this->commandOptionDescription
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument($this->commandArgumentName);

        if ($name) {
            $text = $name;
        } else {
            return "error no model name given";
        }

        if ($input->getOption($this->commandOptionName)) {
            var_dump($input->getOption($this->commandOptionName));
            die();
            $text = strtoupper($text);
        }
        $newFileName = 'Models/' . $text . ".php";
        $newFileContent = '<?php namespace App\Models;
        class ' . $text . ' {
            /** Variables can be edited to taste **/
              public $_id;
              public $username;
              public $passwordHash;
              public $email;
              public $name;

    /**
     * ' . $text . ' constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        if (is_array($data))
        {
            if (isset($data["_id"]))
                $this->_id = $data["_id"];
        }
    }
}';
        $myfile = fopen("Models/" . $text . ".php", "w") or die("Unable to open or create " . $text . ".php file!");
        if ($myfile) {
            if (file_put_contents($newFileName, $newFileContent) !== false) {
                echo "Model created at " . basename($newFileName) . "";
            }
        } else {
            echo "Cannot create Model " . basename($newFileName) . "";
        }
    }
}
