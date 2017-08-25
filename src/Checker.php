<?php

class WPUP_Checker
{
    /** @var array */
    public $checks = array();

    // $arguments = array(
    //     // 'wordpress' => array(
    //     //     array(
    //     //         'version' => '3.7.1',
    //     //         'required' => false,
    //     //     ),
    //     //     array(
    //     //         'version' => '3.5.0',
    //     //         'required' => true,
    //     //     ),
    //     //   ),
    //       'php' => array(
    //         array(
    //           'version' => '7.0.0',
    //           'required' => false,
    //         ),
    //         // array(
    //         //   'version' => '5.6.0',
    //         //   'required' => true,
    //         // ),
    //       ),
    // );

    /** @var array */
    public $arguments = array();

    /** @var array */
    public $failures = array();

    /** @var array */
    public $recommendations = array();

    public function __construct($arguments = array())
    {
        $this->arguments = $arguments;
    }

    public function setup()
    {
        $this->checks = array(
            new WPUP_PhpVersion($this),
            new WPUP_WordPressVersion($this),
        );

        foreach($this->checks as $check) {
            $check->setup();
        }
    }

    public function check()
    {
        /** @var WPUP_Check_Interface $check */
        foreach($this->checks as $check) {
            $check->check();
        }
    }

    public function reportFail($failure)
    {
        $this->failures[] = $failure;
    }

    public function reportRecommendation($recommendation)
    {
        $this->recommendations[] = $recommendation;
    }
}
