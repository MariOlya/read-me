<?php

namespace App\DataFixtures;

use App\Entity\FileType;
use App\Entity\PostType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadFileType($manager);
        $this->loadPostType($manager);
    }

    public function loadFileType(ObjectManager $manager): void
    {
        $types = ['avatar', 'post', 'ad', 'message'];

        foreach ($types as $type) {
            $fileType = new FileType();
            $fileType->setType($type);

            $manager->persist($fileType);
        }

        $manager->flush();
    }

    public function loadPostType(ObjectManager $manager): void
    {
        $types = [
            [
                'type' => 'photo',
                'icon' => '#icon-filter-photo'
            ],
            [
                'type' => 'video',
                'icon' => '#icon-filter-video'
            ],
            [
                'type' => 'text',
                'icon' => '#icon-filter-text'
            ],
            [
                'type' => 'quote',
                'icon' => '#icon-filter-quote'
            ],
            [
                'type' => 'link',
                'icon' => '#icon-filter-link'
            ]
        ];

        foreach ($types as $type) {
            $postType = new PostType();
            $postType->setType($type['type']);
            $postType->setIcon($type['icon']);

            $manager->persist($postType);
        }

        $manager->flush();
    }
}
