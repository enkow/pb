<?php
/**
 * PortalFriend controller.
 */
namespace App\Controller;
use App\Entity\PortalFriend;
use App\Repository\PortalFriendRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class PortalFriendController.
 *
 * @Route("/portalfriend")
 */
class PortalFriendController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\PortalFriendRepository $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="portalfriend_index",
     * )
     */
    public function index(Request $request, PortalFriendRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            PortalFriend::NUMBER_OF_ITEMS
        );
        return $this->render(
            'friend/index.html.twig',
            ['pagination' => $pagination]
        );
    }
    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalFriend                 $portalFriend  PortalFriend  entity
     * @param \App\Repository\PortalFriendRepository      $repository PortalFriend repository
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
     *     name="friend_edit",
     * )
     */
    public function edit(Request $request, PortalFriend $portalFriend, PortalFriend $repository): Response
    {
        $form = $this->createForm(PortalFriendType::class, $portalFriend, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalFriend);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('friend_index');
        }

        return $this->render(
            'friend/edit.html.twig',
            [
                'form' => $form->createView(),
                'friend' => $portalFriend,
            ]
        );
    }
    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PortalFriendRepository      $repository PortalFriend repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="friend_new",
     * )
     */
    public function new(Request $request, PortalFriendRepository $repository): Response
    {
        $portalFriend = new PortalFriend();
        $form = $this->createForm(PortalFriendType::class, $portalFriend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalFriend);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('friend_index');
        }

        return $this->render(
            'friend/new.html.twig',
            ['form' => $form->createView()]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalFriend                    $portalFriend   PortalFriend entity
     * @param \App\Repository\PortalFriendRepository      $repository PortalFriend repository
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
     *     name="friend_delete",
     * )
     */
    public function delete(Request $request, PortalFriend $portalFriend, PortalFriendRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $portalFriend, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->delete($portalFriend);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('friend_index');
        }

        return $this->render(
            'friend/delete.html.twig',
            [
                'form' => $form->createView(),
                'friend' => $portalFriend,
            ]
        );
    }

}

