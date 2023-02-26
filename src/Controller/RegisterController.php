<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\FileType;
use App\Entity\User;
use App\Form\RegisterType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function index(
        Request $request,
        ManagerRegistry $doctrine,
        UserPasswordHasherInterface $passwordHasher,
        SluggerInterface $slugger
    ): Response {
        $newUser = new User();
        $entityManager = $doctrine->getManager();

        $registerForm = $this->createForm(RegisterType::class, $newUser);
        $registerForm->handleRequest($request);

        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $password = $registerForm->get('password')->getData();
            $hashedPassword = $passwordHasher->hashPassword(
                $newUser,
                $password
            );
            $newUser->setPassword($hashedPassword);

            $newUser->setCreateAt(new DateTime());

            $avatarFile = $registerForm->get('avatarId')->getData();
            if ($avatarFile) {
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $avatarFile->guessExtension();
                try {
                    $avatarFile->move(
                        $this->getParameter('avatar_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... разберитесь с исключением, если что-то случится во время загрузки файла
                }

                /** @var FileType $fileType */
                $fileType = $entityManager->getRepository(FileType::class)->findOneBy(['type' => 'avatar']);

                if (!$fileType) {
                    throw $this->createNotFoundException(
                        'No type found for avatar'
                    );
                }

                $typeId = $fileType->getId();

                $avatar = new File();
                $avatar->setFileSrc($newFilename);
                $avatar->setTypeId($typeId);

                $entityManager->persist($avatar);
                $entityManager->flush();

                $avatarId = $avatar->getId();

                $newUser->setAvatarId($avatarId);
            }

            $entityManager->persist($newUser);
            $entityManager->flush();

//            return $this->redirectToRoute('login');
        }

        return $this->render('register/index.html.twig', [
            'form' => $registerForm->createView(),
            'errors' => $registerForm->getErrors(true)
        ]);
    }
}
