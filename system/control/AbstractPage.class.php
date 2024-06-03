<?php
// Dio is VJ6. isto za sve kontrolere.
abstract class AbstractPage {
    protected $data = [];

    public function __construct()
    {
        $this->execute();
        $this->show();
    }

    abstract function execute();

    public function show() {
        // Ostavi templateName error sve klase koje extend-aju ce ga imati definirnog.
        $template = $this->templateName;
        $data = $this->data;
        include_once('system/view/'. $template . '.tpl.php');
    }
}
