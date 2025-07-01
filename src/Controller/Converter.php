<?php

namespace App\Controller;

use App\Entity\Binary;
use App\Form\Type\BinaryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Converter extends AbstractController
{

    #[Route('/', name: 'binary')]
    public function convert(Request $request): Response
    {
        $binary = new Binary();
        $form = $this->createForm(BinaryType::class, $binary);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $binary = $form->getData();

            $decimal = $this->convertBinaryToDecimal($binary);

            return $this->redirectToRoute('binary', [
                'decimal' => $decimal,
                'form' => $form
            ]);
        }

        return $this->render('binary.html.twig', [
            'form' => $form
        ]);
    }

    private function convertBinaryToDecimal(string $source): int
    {
        $binary = array_reverse(mb_str_split($source));
        $decimal = 0;

        for ($i = 0; $i < count($binary); $i++) {
            if ($binary[$i] == '0') {
                continue;
            } else {
                $decimal += pow(2, $i);
            }
        }

        return $decimal;
    }
}
