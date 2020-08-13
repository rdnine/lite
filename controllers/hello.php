<?php

$tpl = Lite::c2r([
  "hello-world" => "Lite", 
  "description" => "Direct, Simple and Elegant!"
], Lite::load('hello'));

Lite::render($tpl);