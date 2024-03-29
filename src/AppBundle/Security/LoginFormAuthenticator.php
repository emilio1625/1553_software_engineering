<?php
/**
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 29/12/16 07:36 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 29/12/16
 * Time: 07:36 PM
 */

namespace AppBundle\Security;


use AppBundle\Form\LoginFormType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;


class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var EntityManager */
    private $em;
    /** @var RouterInterface */
    private $router;
    /** @var UserPasswordEncoder */
    private $passwordEncoder;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManager $em,
        RouterInterface $router,
        UserPasswordEncoder $passwordEncoder
    )
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array). If you return null, authentication
     * will be skipped.
     *
     * @param Request $request
     *
     * @return mixed|null
     */
    public function getCredentials(Request $request)
    {
        $isLoginSubmmit = $request->getPathInfo() === '/login' && $request->isMethod('POST');

        if (!$isLoginSubmmit) {
            return;
        }

        $form = $this->formFactory->create(LoginFormType::class);
        $form->handleRequest($request);

        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );

        return $data;
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @throws AuthenticationException
     *
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];


        // check if user is a doctor

        $user = $this->em->getRepository('AppBundle:Doctor')->findOneBy(['username' => $username]);
        // otherwise is a patient
        if (!$user) {
            $user = $this->em->getRepository('AppBundle:Patient')->findOneBy(['username' => $username]);
        }

        return $user;
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['_password']);
    }

    /**
     * Return the URL to the login page.
     *
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }

    /**
     * If there's no previous visited page go to homepage
     *
     * @return string
     */
    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('homepage');
    }

    /**
     * Return the user to where it was before the login
     *
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $targetPath = $this->getTargetPath($request->getSession(), $providerKey);

        if (!$targetPath) {
            $targetPath = $this->getDefaultSuccessRedirectUrl();
        }

        return new RedirectResponse($targetPath);
    }


}
