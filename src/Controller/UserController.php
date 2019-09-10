<?php
/**
 * User controller.
 */
namespace App\Controller;
use App\Entity\PortalUser;
use App\Form\UserType;
use App\Repository\PortalUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class UserController.
 *
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\PortalUserRepository $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="user_index",
     * )
     */
    public function index(Request $request, PortalUserRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            PortalUser::NUMBER_OF_ITEMS
        );
        return $this->render(
            'user/index.html.twig',
            ['pagination' => $pagination]
        );
    }
    /**
     * View action.
     *
     * @param \App\Entity\PortalUser $portalUser portalUser entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     name="user_view",
     *     requirements={"id": "[1-9]\d*"},
     * )
     */
    public function view(PortalUser $portalUser): Response
    {
        return $this->render(
            'user/view.html.twig',
            ['user' => $portalUser]
        );
    }
    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PortalUserRepository      $repository portalUser repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="user_new",
     * )
     */
    public function new(Request $request, PortalUserRepository $repository, $portalUser): Response
    {
        $portalUser = new portalUser();
        $form = $this->createForm(UserType::class, $portalUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalUser);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('user_index');
        }

        return $this->render(
            'user/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\PortalUser                    $portalUser Category entity
     * @param \App\Repository\PortalUserRepository      $repository PortalUser repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="user_edit",
     * )
     */
    public function edit(Request $request, PortalUser $portalUser, PortalUserRepository $repository): Response
    {
        $form = $this->createForm(UserType::class, $portalUser, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalUser);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('user_index');
        }

        return $this->render(
            'user/edit.html.twig',
            [
                'form' => $form->createView(),
                'user' => $portalUser,
            ]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalUser                 $portalUser User entity
     * @param \App\Repository\PortalUserRepository       $repository Category repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="user_delete",
     * )
     */
    public function delete(Request $request, PortalUser $portalUser, PortalUserRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $portalUser, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->delete($portalUser);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('user_index');
        }

        return $this->render(
            'user/delete.html.twig',
            [
                'form' => $form->createView(),
                'user' => $portalUser,
            ]
        );
    }
}
