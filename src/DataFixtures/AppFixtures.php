<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Objet;

use App\Entity\Messages;
use App\Entity\Categories;
use App\Entity\CategoriesDetails;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger, private UserPasswordHasherInterface $passwordEnCode)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $categories = new Categories();
        $categories->setName('Portefeuille et CB & argent');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName('Papiers et documents officiels');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName('Sacs & Bagages');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName('Bijoux, montres');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName('vêtements et accessoires');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName('Animaux');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName('Effets personnels');
        $manager->persist($categories);

        $categories = new Categories();
        $categories->setName(' Divers');
        $manager->persist($categories);
        $manager->flush();


        //////////////////////////Categorydetails//////////////////////////

        $faker = Factory::create('fr_FR');
  
            $categoriesdetails = new CategoriesDetails();

            $categoriesdetails->setName("Portefeuille");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("CB");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);
            
            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Argent");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Papiers");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Documents officiels");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Sacs");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Bagages");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Bijoux");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("montres");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("vêtements");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("accessoires");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);
            
            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Chat");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);



            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Chien");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Clés, bips, badges");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Lunettes");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Objet non référencé");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Cosmétique");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Livre, papeterie");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Parapluie");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Canne de marche");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Médicaments");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategorie($categories);
            $manager->persist($categoriesdetails);






            $manager->flush();
       





        //////////////////////////////////Users//////////////////////////
        {
            $admin = new User();
            $admin->setEmail('allaabdelazize@gmail.com');
           // $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->passwordEnCode->hashPassword($admin, 'capilo09'));
            $admin->setSecondname('abdelaziz');
            $admin->setFirstName('alla');
            $admin->setAddress('14 avenue des chenes');
            $admin->setZipCode('91200');
            $admin->setCity('athismons');
            $admin->setphone('0615624270');
            $admin->setIsVerified($faker->randomElement([true, false]));

            $manager->persist($admin);


            $faker = Factory::create('fr_FR');
            for ($i = 1; $i <= 15; $i++) {
                $user = new User();
                $user->setEmail($faker->email);
             //   $user->setRoles(['ROLE_USER']);
                $user->setPassword($this->passwordEnCode->hashPassword($user, 'capilo09'));
                $user->setSecondname($faker->lastName);
                $user->setCivilite($faker->randomElement(['monsieur', 'madame']));
                $user->setFirstName($faker->firstName);
                $user->setAddress($faker->streetAddress);
                $user->setZipCode(str_replace(' ', '', $faker->postcode));
                $user->setCity($faker->city);
                $user->setphone($faker->phoneNumber);
                $user->setIsVerified($faker->randomElement([true, false]));

                $manager->persist($user);

                $manager->flush();
            }
        }

        ///////////////////////messages//////////////////////////////////


        ///////////////////////object//////////////////////////////////
        {
            $faker = Factory::create('fr_FR');
            for ($su = 1; $su <= 15; $su++){
                $Objet = new Objet();

                $Objet->setName( "object".$su);
                $Objet->setUser($user);
                $Objet->setStatus($faker->randomElement([true, false]));
                $Objet->setIsfound($faker->randomElement([true, false]));
                $Objet->setLostAdress($faker->streetAddress);
                $Objet->setLostZip(str_replace(' ', '', $faker->postcode));
                $Objet->setLostCity($faker->city);
                $Objet->setLostDate($faker->dateTimeBetween('-1 year', '+1 week'));
           //    $Objet->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true));
                $Objet->setClues("lorem1245626");
                $Objet->setCategory($categories);
                $Objet->setImage("public/images/cc.jpg");
                $Objet->setCategoryDetails($categoriesdetails);
                $Objet->setActive($faker->randomElement([true, false]));
                $manager->persist($Objet);
                $manager->flush();
            }
        }

    }
}
