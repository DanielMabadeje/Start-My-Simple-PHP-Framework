<?php namespace App\Models;
        class codes {
            /** Variables can be edited to taste **/
              public $_id;
              public $username;
              public $passwordHash;
              public $email;
              public $name;

    /**
     * codes constructor.
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
}