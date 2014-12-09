<?php
namespace OneNamespace;
	class FirstClass
	{
		private $secondClass;
		public function __construct(SecondClass $secondClass)
		{
		$this->secondClass = $secondClass;
		}
	}
	class SecondClass
	{
		private $thirdClass;
		private $vehicle;
		public function __construct(\AnotherNamespace\ThirdClass $thirdClass,$vehicle)
		{
		$this->thirdClass = $thirdClass;
		$this->vehicle = $vehicle;
		}
	}

namespace AnotherNamespace;

		class ThirdClass
		{
			private $first_name;
			private $last_name;
			
			public function __construct($first_name, $last_name)
			{
				$this->first_name = $first_name;
				$this->last_name = $last_name;
			}
		}

// Let us now create the example through the classic
// method.
$thirdClass = new ThirdClass("John", "Doe");
$secondClass = new \OneNamespace\SecondClass($thirdClass,'Motorcycle');
$firstClass = new \OneNamespace\FirstClass($secondClass);
echo "success";
