<?php

namespace App\Controller;

use App\Domain\Expenses\Patterns;
use App\Domain\Mobi\Parser\CsvParser;
use App\Form\ReportUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/report", name="report")
     */
    public function index(): Response
    {
        $form = $this->createForm(ReportUploadType::class);

        return $this->render(
            'report/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/report/process", name="report_process", methods={"POST"})
     */
    public function process(Request $request)
    {
        $form = $this->createForm(ReportUploadType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $this->redirectToRoute('report');
        }


        /** @var UploadedFile $reportCsv */
        $reportCsv = $form->get('report_csv')->getData();

        $parser = new CsvParser($reportCsv->getPathname());
        $expenseItems = $parser->parse();

        $patterns = new Patterns();
        $patterns->loadFromYaml();

        foreach ($expenseItems as $expenseItem) {
            $patterns->categorize($expenseItem);
        }


        return $this->render(
            'report/process.html.twig',
            [
                'expenseItems' => $expenseItems
            ]
        );
    }
}
