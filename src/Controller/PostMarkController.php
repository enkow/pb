<?php
/**
 * PostMark controller.
 */
namespace App\Controller;
use App\Entity\PostMark;
use App\Repository\PostMarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class PostMarkController.
 *
 * @Route("/postmark")
 */
class PostMarkController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\PostMarkRepository $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="postmark_index",
     * )
     */
    public function index(Request $request, PostMarkRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            PostMark::NUMBER_OF_ITEMS
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
     * @param \App\Entity\PostMark                  $postMark  PostMark  entity
     * @param \App\Repository\PostMarkRepository       $repository PostMark repository
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
     *     name="mark_edit",
     * )
     */
    public function edit(Request $request, PostMark $postMark, PostMarkRepository $repository): Response
    {
        $form = $this->createForm(PostMarkType::class, $postMark, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($postMark);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('mark_index');
        }

        return $this->render(
            'mark/edit.html.twig',
            [
                'form' => $form->createView(),
                'mark' => $postMark,
            ]
        );
    }
    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PostMarkRepository      $repository PostMark repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="mark_new",
     * )
     */
    public function new(Request $request, PostMarkRepository $repository): Response
    {
        $postMark = new PostMark();
        $form = $this->createForm(PostMarkType::class, $postMark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($postMark);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('mark_index');
        }

        return $this->render(
            'mark/new.html.twig',
            ['form' => $form->createView()]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PostMark                      $postMark   PostMark entity
     * @param \App\Repository\PostMarkRepository       $repository PostMark repository
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
     *     name="mark_delete",
     * )
     */
    public function delete(Request $request, PostMark $postMark, PostMarkRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $postMark, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->delete($postMark);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('mark_index');
        }

        return $this->render(
            'mark/delete.html.twig',
            [
                'form' => $form->createView(),
                'mark' => $postMark,
            ]
        );
    }
}
