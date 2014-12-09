<?php
namespace Huser\Options;

interface  UserModuleOptionsAwareInterface
{
        public function setUserMoudleOptions(\Huser\Options\UserModuleOptions $userModuleOptions);
        public function getUserModuleOptions();
}

