<?php

$tpl = Lite::c2r(["hello-world" => "Hello World!"], Lite::load('hello'));

Lite::render($tpl);