<?php
class Table{
    public $call = "";

    public $default = ["<table class='table %s'>"];

    public $thead = ["\t<thead>", "\t<thead>"];

    public $tbody = ["\t<tbody>", "\t</tbody>"];

    public $head_tr = [];

    public $body_tr = [];

    public function __construct(public $table_class ="")
    {
        $this->default[0] = sprintf($this->default[0], $table_class);
    }
    public function thead() {
        $this->call = "head_tr";
        return $this;

    }

    public function tbody(){
        $this->call = "body_tr";
        return $this;
    }

    public function tr(){
        array_push($this->{$this->call}, ...["\t\t<tr>", "\t\t</tr>"]);
        return $this;
    }


    public function th($str="", $class=""){
        array_splice($this->{$this->call}, -1, 0, ["\t\t\t<th scope='$class'>", "\t\t\t\t$str", "\t\t\t</th>"]);
        return $this;


    }


    public function td($str, $class=""){
        array_splice($this->{$this->call}, -1, 0, ["\t\t\t<td class='$class'>", "\t\t\t\t$str", "\t\t\t</td>"]);
        return $this;

    }

    public function getResult()
    {

        array_splice($this->thead,-1, 0, $this->head_tr);
        array_splice($this->tbody,-1, 0, $this->body_tr);
        array_push($this->default, ...$this->thead, ...$this->tbody, ...["</table>"]);
        echo implode("\n", $this->default);
    }
}

$Table = new Table("table-striped");

//add table header

$Table->thead();

// header row
$Table->tr()
    ->th("links", "col")
    ->th("first", "col")
    ->th("last", "col");

// add table body
$Table->tbody();

//add body row
$Table->tr()
    ->th("instagram", 'row')
    ->td('imalireza')
    ->td('.py');

// add body row
$Table->tr()
    ->th("telegram", 'row')
    ->td('imalireza')
    ->td('_py');

//add body row
$Table->tr()
    ->th("github", 'row')
    ->td('imalireza')
    ->td('py');


$Table->getResult();
