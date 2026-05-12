# Design Pattern
## Creational patterns
### 1. Factory Design Pattern
#### i. UnOfficial Factory Method
- Whe we have multiple subclasses then we use the simple factory design pattern
```php
interface Animal {
    public function speak();
}
class Dog implements Animal {
    public function speak() {
        return "Bark";
    }
}

class Cat implements Animal {
    public function speak() {
        return "Meow";
    }
}

AnimalFactory.php
class AnimalFactory {
    public static function create($type): Animal {
        if ($type == 'dog') {
            return new Dog();
        }
        if ($type == 'cat') {
            return new Cat();
        }
        throw new Exception("Unknown animal");
    }
}
# usages
$animal = AnimalFactory::create('dog');
echo $animal->speak();
```

#### i. Official Factory Method 
- unOfficial Factory Method Included
- Different objects may require different creation processes.
- run code logic before creating the each object
- without official factory method , file code heavey ho jata hai
```
if ($type == 'dog') {
    // dog logic
}
if ($type == 'cat') {
    // cat logic
}
```
- Full Example Code 
```php
<?php
/*** create main code ***/
// AninamlInterface.php
interface Animal {
    public function sound();
}
// DogClass.php
class Dog implements Animal {
    public function sound() {
        return "Bark";
    }
}
//CatClass.php
class Cat implements Animal {
    public function sound() {
        return "Meow";
    }
}
/*** end ***/

/** Factory Creation for Run Code Logic Before Creating the Objects... **/
// AnimalFactory.php
abstract class AnimalFactory {
    // Factory Method
    abstract public function createAnimal(): Animal;

    public function makeSound() {
        $animal = $this->createAnimal();
        return $animal->sound();
    }
}

// DogFactory.php
class DogFactory extends AnimalFactory {
    public function createAnimal(): Animal {
        // custom logic before object creation,  dog creation, validation, loggign, config, dependencies
        echo "Creating Dog...\n";
        return new Dog();
    }
}
CatFactory.php
class CatFactory extends AnimalFactory {
    public function createAnimal(): Animal {
        echo "Creating Cat...\n";
        return new Cat();
    }
}
/** End **/

//AnimalFactoryManager.php
class AnimalFactoryManager {
    public static function make($type): AnimalFactory {
        return match($type) {
            'dog' => new DogFactory(),
            'cat' => new CatFactory(),
            default => throw new Exception("Invalid Type")
        };
    }
}
// Usages...
$factory = new AnimalFactoryManager('dog');
echo $factory->makeSound();
```
### 2. Abstract Factory
- **MULTIPLE related products** create karta hai & **factory method ONE product** create karta hai
- Full Example Real Life
```php
/**** Main Code ****/
// ProductInterface.php
interface Button {
    public function render();
}
interface Card {
    public function render();
}

// 1. Lite Theme Product
class LightButton implements Button {
    public function render() {
        return "Light Button";
    }
}
class LightCard implements Card {
    public function render() {
        return "Light Card";
    }
}

// 2. Dark Theme Product
class DarkButton implements Button {
    public function render() {
        return "Dark Button";
    }
}
class DarkCard implements Card {
    public function render() {
        return "Dark Card";
    }
}
/**** End  ****/

/****Abstract Factory: Same as Before Create Object : Run Sepcif Logic or Conifg ***/
interface ThemeFactory {
    public function createButton(): Button;
    public function createCard(): Card;
}
// Light Theme Factory
class LightThemeFactory implements ThemeFactory {
    public function createButton(): Button {
        return new LightButton();
    }
    public function createCard(): Card {
        return new LightCard();
    }
}

// Dark Theme Factory
class DarkThemeFactory implements ThemeFactory {
    public function createButton(): Button {
        return new DarkButton();
    }
   public function createCard(): Card {
        return new DarkCard();
    }
}
/*** End Factory ****/

//ThemeFactoryManager.php
class ThemeFactoryManager {
    public static function make($type): AnimalFactory {
        return match($type) {
            'light' => new LightThemeFactory(),
            'dar' => new DarkThemeFactory(),
            default => throw new Exception("Invalid Type")
        };
    }
}

// Usages
$factory = new ThemeFactoryManager("dark") // you can add it more in future...
$button = $factory->createButton();
$card = $factory->createCard();

echo $button->render();
echo PHP_EOL;
echo $card->render();

```
### 3. Builder
- use when there are many parameters & optional
- Database SQL mei mostly used hota hai builder ka
```php
// ReportBuilderInterface.php
interface ReportBuilder {
    public function setHeader();
    public function setBody();
    public function setFooter();
    public function build();
}
// PDFBuilder.php
class PdfReportBuilder implements ReportBuilder {
    public function setHeader() {
        echo "PDF Header\n";
    }
    public function setBody() {
        echo "PDF Body\n";
    }
    public function setFooter() {
        echo "PDF Footer\n";
    }
    public function build() {
        echo "PDF Generated\n";
    }
}
// usages
$builder = new PdfReportBuilder();
$builder->setHeader();
$builder->setBody();
$builder->setFooter();
$builder->build();
```

## 4. Porotype
- use when new object banana expensive ya repetitive ho
- when use bluk operation
- Performance Improve Karni Ho
```php
class User {
    public $name;
    public $role;
    public function __construct() {
        echo "Heavy object creation...\n";
    }
}
// usage case
// i. Create Original Object
$admin = new User();
$admin->role = 'admin';

// 2. cloen it
$user1 = clone $admin;
$user1->name = 'Rahul';

$user2 = clone $admin;
$user2->name = 'Amit';
```
## 5. Singleton Pattern
- when object ek baar create krna ho aur same har jagah use krna ho, ex. database connection in one project used everywhere
- when single logging system need in whole project
- single cache handler
- its create only one object..
```php
class Database {
    private static $instance = null;

    // Prevent direct object creation
    private function __construct() {}

    // Get single instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function connect() {
        return "Database Connected";
    }
}
$db1 = Database::getInstance();
$db2 = Database::getInstance();
echo $db1->connect();

// verify it... & it will return true ; if same instance.......
var_dump($db1 === $db2); 
```


## Structural patterns

## Behavioral patterns

