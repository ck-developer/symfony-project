<?php

namespace Ck\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Ck\CoreBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ck\ProductBundle\Entity\Tax;
use Ck\ProductBundle\Form\TaxType;

/**
 * Tax controller.
 *
 * @Route("/tax")
 */
class TaxController extends Controller
{
    /**
     * Lists all Tax entities.
     *
     * @Route("/", name="tax_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taxes = $em->getRepository('CkProductBundle:Tax')->findAll();

        $pagination = $this->paginate($taxes);

        return $this->render('CkProductBundle:Tax:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new Tax entity.
     *
     * @Route("/new", name="tax_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tax = new Tax();
        $form = $this->createForm('Ck\ProductBundle\Form\TaxType', $tax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tax);
            $em->flush();

            return $this->redirectToRoute('tax_show', array('id' => $tax->getId()));
        }

        return $this->render('CkProductBundle:Tax:new.html.twig', array(
            'tax' => $tax,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tax entity.
     *
     * @Route("/{id}", name="tax_show")
     * @Method("GET")
     */
    public function showAction(Tax $tax)
    {
        $deleteForm = $this->createDeleteForm($tax);

        return $this->render('tax/show.html.twig', array(
            'tax' => $tax,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tax entity.
     *
     * @Route("/{id}/edit", name="tax_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tax $tax)
    {
        $deleteForm = $this->createDeleteForm($tax);
        $editForm = $this->createForm('Ck\ProductBundle\Form\TaxType', $tax);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tax);
            $em->flush();

            return $this->redirectToRoute('tax_edit', array('id' => $tax->getId()));
        }

        return $this->render('CkProductBundle:Tax:edit.html.twig', array(
            'tax' => $tax,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tax entity.
     *
     * @Route("/{id}", name="tax_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tax $tax)
    {
        $form = $this->createDeleteForm($tax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tax);
            $em->flush();
        }

        return $this->redirectToRoute('tax_index');
    }

    /**
     * Creates a form to delete a Tax entity.
     *
     * @param Tax $tax The Tax entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tax $tax)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tax_delete', array('id' => $tax->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
