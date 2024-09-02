<?php
class Person
{
    private string $firstName;
    private string $lastName;
    private string $middleName;
    private int $birthYear;

    public function __construct(string $firstName,string $lastName,string $middleName,int $birthYear)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->birthYear = $birthYear;
    }

    public function getFullName(): string
    {
        return $this->lastName . ' ' . $this->firstName . ' ' . $this->middleName;
    }

    public function getBirthYear(): int
    {
        return $this->birthYear;
    }
}

class Apartment
{
    private int $number;
    private Person $person;

    public function __construct(int $number, Person $person)
    {
        $this->number = $number;
        $this->person = $person;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }
}

class Entrance
{
    private int $countOfFloors;
    private int $countApartmentsFloor;
    private array $apartments = [];

    public function __construct(int $floors, int $countApartmentsFloor)
    {
        $this->floors = $floors;
        $this->countApartmentsFloor = $countApartmentsFloor;
    }

    public function addApartment(Apartment $apartment): void
    {
        $this->apartments[] = $apartment;
    }

    public function getFloors(): int
    {
        return $this->floors;
    }

    public function getCountApartmentsFloor(): int
    {
        return $this->countApartmentsFloor;
    }

    public function getApartments(): array
    {
        return $this->apartments;
    }
}

class House
{
    private array $entrances = [];

    public function addEntrance(Entrance $entrance): void
    {
        $this->entrances[] = $entrance;
    }

    public static function findPerson(House $house, int $apartmentNumber): ?array
    {
        foreach ($house->entrances as $entranceIndex => $entrance) {
            foreach ($entrance->getApartments() as $apartmentIndex => $apartment) {
                if ($apartment->getNumber() === $apartmentNumber) {
                    $person = $apartment->getPerson();
                    $floor = intdiv($apartmentIndex, $entrance->getCountApartmentsFloor()) + 1;
                    return [
                        'fullName' => $person->getFullName(),
                        'floor' => $floor,
                        'entrance' => $entranceIndex + 1,
                    ];
                }
            }
        }
        return null;
    }
}

$person = new Person('Иванов', 'Иван', 'Иванович', 1987);

$apartment = new Apartment(1, $person);

$entrance = new Entrance(5, 2);
$entrance->addApartment($apartment);

$house = new House();
$house->addEntrance($entrance);

$result = House::findPerson($house, 10);
if ($result) {
    echo "ФИО: " . $result['fullName'] . "\n";
    echo "Этаж: " . $result['floor'] . "\n";
    echo "Подьезд: " . $result['entrance'] . "\n";
} else {
    echo "Квартира не найдена.\n";
}