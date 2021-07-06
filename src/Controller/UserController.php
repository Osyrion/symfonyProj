<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; // @dth: to encode the pass


class UserController extends AbstractApiController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function indexAction(Request $request): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->json($users);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(UserType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user */
        $user = $form->getData();

        $plainpwd = $user->getPassword();
        $encoded = $this->passwordEncoder->encodePassword($user, $plainpwd);
        $user->setPassword($encoded);

        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($user);
    }
}
