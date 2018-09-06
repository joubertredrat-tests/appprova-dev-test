<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\DataFixtures;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Entity\Score;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * AppFixture
 *
 * @package AppBundle\DataFixtures
 */
class AppFixture extends Fixture
{
    /**
     * {@inheritdoc}
     * @throws \AppProva\Domain\Exception\Institution\InvalidScoreException
     * @throws \AppProva\Domain\Exception\Score\InvalidScoreException
     */
    public function load(ObjectManager $manager)
    {
        $institution1 = new Institution();
        $institution1->setName("Centro Universitário Foo");
        $institution1->setGeneralScore(100);

        $institution2 = new Institution();
        $institution2->setName("Universidade Bar One");
        $institution2->setGeneralScore(100);

        $institution3 = new Institution();
        $institution3->setName("Universidade Bar Two");
        $institution3->setGeneralScore(100);

        $institution4 = new Institution();
        $institution4->setName("Centro Universitário Baz");
        $institution4->setGeneralScore(100);

        $manager->persist($institution1);
        $manager->persist($institution2);
        $manager->persist($institution3);
        $manager->persist($institution4);
        $manager->flush();

        $course1 = new Course();
        $course1->setName("Sistemas de Informação");

        $course2 = new Course();
        $course2->setName("Engenharia de Computação");

        $course3 = new Course();
        $course3->setName("Engenharia Ambiental");

        $course4 = new Course();
        $course4->setName("Ciência da Computação");

        $manager->persist($course1);
        $manager->persist($course2);
        $manager->persist($course3);
        $manager->persist($course4);
        $manager->flush();

        $score11 = new Score();
        $score11->setInstitution($institution1);
        $score11->setCourse($course1);
        $score11->setCourseGeneralScore(70);
        $score11->setCourseStudentAvgScore(65);

        $score12 = new Score();
        $score12->setInstitution($institution1);
        $score12->setCourse($course2);
        $score12->setCourseGeneralScore(71);
        $score12->setCourseStudentAvgScore(61);

        $score13 = new Score();
        $score13->setInstitution($institution1);
        $score13->setCourse($course4);
        $score13->setCourseGeneralScore(79);
        $score13->setCourseStudentAvgScore(68);

        $manager->persist($score11);
        $manager->persist($score12);
        $manager->persist($score13);
        $manager->flush();

        $score21 = new Score();
        $score21->setInstitution($institution2);
        $score21->setCourse($course3);
        $score21->setCourseGeneralScore(47);
        $score21->setCourseStudentAvgScore(84);

        $manager->persist($score21);
        $manager->flush();

        $score31 = new Score();
        $score31->setInstitution($institution3);
        $score31->setCourse($course2);
        $score31->setCourseGeneralScore(56);
        $score31->setCourseStudentAvgScore(74);

        $score32 = new Score();
        $score32->setInstitution($institution3);
        $score32->setCourse($course3);
        $score32->setCourseGeneralScore(61);
        $score32->setCourseStudentAvgScore(73);

        $manager->persist($score31);
        $manager->persist($score32);
        $manager->flush();

        $score41 = new Score();
        $score41->setInstitution($institution4);
        $score41->setCourse($course1);
        $score41->setCourseGeneralScore(75);
        $score41->setCourseStudentAvgScore(70);

        $manager->persist($score41);
        $manager->flush();
    }
}
