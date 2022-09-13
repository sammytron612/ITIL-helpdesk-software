<?php
namespace App\Http\Interfaces;

interface optionalFields
    {
        public function isMandatory($field);

        public function isToBeShown($field);

    }
