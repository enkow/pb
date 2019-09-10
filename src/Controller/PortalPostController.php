<?php
/**
 * PortalPost controller.
 */
namespace App\Controller;

use App\Entity\PortalPost;
use App\Repository\PortalPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class PortalPostController.
 *
 * @Route("/portalpost")
 */
class PortalPostController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\PortalPostRepository $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="portalpost_index",
     * )
     */
    public function index(Request $request, PortalPostRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            PortalPost::NUMBER_OF_ITEMS
        );
        return $this->render(
            'user/index.html.twig',
            ['pagination' => $pagination]
        );
    }
    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalPost                  $portalPost  PortalPost  entity
     * @param \App\Repository\PortalPostRepository       $repository PortalPost repository
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
     *     name="post_edit",
     * )
     */
    public function edit(Request $request, PortalPost $portalPost, PortalPostRepository $repository): Response
    {
        $form = $this->createForm(PortalPostType::class, $portalPost, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalPost);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('post_index');
        }

        return $this->render(
            'post/edit.html.twig',
            [
                'form' => $form->createView(),
                'post' => $portalPost,
            ]
        );
    }
    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PortalPostRepository      $repository PortalPost repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="post_new",
     * )
     */
    public function new(Request $request, PortalPostRepository $repository): Response
    {
        $portalPost = new PortalPost();
        $form = $this->createForm(PortalPostType::class, $portalPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalPost);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('post_index');
        }

        return $this->render(
            'post/new.html.twig',
            ['form' => $form->createView()]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalPost                      $portalPost   PortalPost entity
     * @param \App\Repository\PortalPostRepository       $repository PortalPost repository
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
     *     name="post_delete",
     * )
     */
    public function delete(Request $request, PortalPost $portalPost, PortalPostRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $portalPost, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->delete($portalPost);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('post_index');
        }

        return $this->render(
            'post/delete.html.twig',
            [
                'form' => $form->createView(),
                'post' => $portalPost,
            ]
        );
    }
}
