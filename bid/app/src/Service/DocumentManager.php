<?php

namespace App\Service;

use App\Entity\AO;
use App\Entity\User;
use App\Service\AO\AOUtils;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use TCPDF;

class DocumentManager
{

    public function __construct(
        readonly ParameterBagInterface $params,
        readonly Filesystem            $filesystem,
        readonly AOUtils               $AOUtils,
    )
    {
    }

    public function generateDossier(AO $ao, User $user): AO
    {
        $projectDir = $this->params->get('kernel.project_dir');
        $outputDir = $projectDir . '/public/uploads/pdf/';
        $outputPath = $outputDir . 'soumission_' . $ao->getId() . '.pdf';

        $this->filesystem->mkdir($outputDir);

        // 1. Initialisation TCPDF
        $pdf = new \TCPDF(
            'P',
            'mm',
            'A4',
            true,
            'UTF-8',
        );

        $pdf->SetCreator('AO Burkina');
        $pdf->SetAuthor($user->getEmail());
        $pdf->SetTitle('Soumission ' . $ao->getReference());
        $pdf->SetAutoPageBreak(true, 25);

        // Police moderne (Helvetica est la plus propre dans TCPDF)
        $pdf->SetFont('helvetica', '', 10);

        // Couleur de texte principale (noir doux)
        $pdf->SetTextColor(60, 60, 60);

        // Ajout de la page
        $pdf->AddPage();

        // 3. En-tête professionnel
        $this->addModernHeader($pdf, $ao);

        // 4. Watermark discret
        $this->addDiscreteWatermark($pdf, $user, $ao);

        // 5. Contenu principal structuré
        $this->addStructuredContent($pdf, $ao, $user);

        // 6. Pied de page professionnel
        $this->addModernFooter($pdf, $user);

        // Sauvegarde
        $pdf->Output($outputPath, 'F');

        $documentData = [
            'id' => null,
            'Nom Fichier' => 'soumission_' . $ao->getId() . '.pdf',
            'ao' => $ao->getId()
        ];
        $ao->setPdfPath('/uploads/pdf/soumission_' . $ao->getId() . '.pdf');
        $this->AOUtils->logDocument($ao, $user, $documentData, 'DOCUMENT_DELETE');

        return $ao;
    }

    private function addModernHeader(TCPDF $pdf, AO $ao): void
    {
        // Fond d'en-tête
        $pdf->SetFillColor(245, 245, 245);
        $pdf->Rect(0, 0, 210, 30, 'F');

        // Logo (à adapter avec votre chemin)
        $logoPath = $this->params->get('kernel.project_dir') . '/public/images/logo.png';
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 20, 10, 30, 0, 'PNG');
        }

        // Titre principal
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->SetTextColor(29, 78, 216); // Bleu professionnel
        $pdf->SetXY(60, 12);
        $pdf->Cell(0, 0, 'SOUMISSION POUR APPEL D\'OFFRES', 0, 1);

        // Référence
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetTextColor(60, 60, 60);
        $pdf->SetXY(60, 20);
        $pdf->Cell(0, 0, 'Référence: ' . $ao->getReference(), 0, 1);

        // Ligne de séparation
        $pdf->SetDrawColor(29, 78, 216);
        $pdf->Line(20, 30, 190, 30);
    }

    private function addDiscreteWatermark(TCPDF $pdf, User $user, AO $ao): void
    {
        $text = 'CONFIDENTIEL - ' . $ao->getEntreprise()->getNom();
        $tempImage = tempnam(sys_get_temp_dir(), 'watermark') . '.png';

        // Création d'une image watermark
        $image = imagecreatetruecolor(800, 400);
        $bg = imagecolorallocatealpha($image, 255, 255, 255, 127);
        imagefill($image, 0, 0, $bg);
        $textColor = imagecolorallocatealpha($image, 150, 150, 150, 90);
        imagettftext($image, 15, 45, 290, 350, $textColor, '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf', $text);
        imagepng($image, $tempImage);
        imagedestroy($image);

        // Insertion dans le PDF
        $pdf->SetAlpha(0.3);
        $pdf->Image(
            $tempImage,
            $x = 0,
            $y = 0,
            $w = $pdf->getPageWidth(),
            $h = $pdf->getPageHeight(),
            'PNG',
            '',
            '',
            true,
            300,
            '',
            false,
            false,
            0,
            false,
            false,
            true
        );
        $pdf->SetAlpha(1);

        unlink($tempImage);
    }

    private function addStructuredContent(TCPDF $pdf, AO $ao, User $user): void
    {
        // Positionnement après l'en-tête
        $pdf->SetY(40);

        // Section 1: Informations sur l'offre (version compacte)
        $this->addCompactContentSection($pdf, 'INFORMATIONS SUR L\'OFFRE', [
            ['Titre', $ao->getTitre()],
            ['Référence', $ao->getReference()],
            ['Budget', number_format($ao->getBudget(), 0, ',', ' ') . ' XOF'],
            ['Date de clôture', $ao->getDateLimite()->format('d/m/Y H:i')],
            ['Secteur', strtoupper($ao->getEntreprise()->getSectorCode()->getLabel())]
        ]);

        // Section 2 : Informations sur le soumissionnaire (version compacte)
        $this->addCompactContentSection($pdf, 'INFORMATIONS SUR LE SOUMISSIONNAIRE', [
            ['Entreprise', strtoupper($ao->getEntreprise()->getNom())],
            ['Représentant', $user->getFirstname()],
            ['Email', $user->getEmail()],
            ['Téléphone', $user->getPhoneNumber()]
        ]);

        // Section 3 : Description détaillée (version concise)
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 8, 'DESCRIPTION DÉTAILLÉE', 0, 1, 'L', true);
        $pdf->SetFont('helvetica', '', 10);

        // Description raccourcie si nécessaire
        $description = strip_tags($ao->getDescription());
        if (strlen($description) > 800) {
            $description = substr($description, 0, 800) . '... [suite disponible dans l\'offre complète]';
        }
        $pdf->MultiCell(0, 6, $description, 0, 'L', false, 1, '', '', true, 0, false, true, 40); // Hauteur max 40mm

        // Ajout du QR Code dans l'espace restant
        $this->addQrCode($pdf, $ao, $user);
    }

    private function addCompactContentSection(TCPDF $pdf, string $title, array $data): void
    {
        $pdf->SetFont('helvetica', 'B', 11); // Taille réduite
        $pdf->SetTextColor(60, 60, 60);
        $pdf->SetFillColor(245, 245, 245);
        $pdf->Cell(0, 7, $title, 0, 1, 'L', true); // Hauteur réduite

        $pdf->SetFont('helvetica', '', 9); // Taille réduite
        foreach ($data as $item) {
            $pdf->Cell(40, 5, $item[0] . ':', 0, 0, 'R'); // Largeur réduite
            $pdf->SetFont('', 'B');
            $pdf->Cell(0, 5, $item[1], 0, 1);
            $pdf->SetFont('');
        }

        $pdf->Ln(3); // Espacement réduit
    }

    private function addQrCode(TCPDF $pdf, AO $ao, User $user): void
    {
        // Positionnement intelligent en fonction de l'espace restant
        $yPos = max($pdf->GetY(), 180); // Ne pas dépasser le bas de page
        $yPos = min($yPos, 250); // Limite supérieure

        $qrCode = new QrCode("AO:{$ao->getId()}/User:{$user->getId()}");
        $writer = new PngWriter();
        $tempPath = sys_get_temp_dir() . '/qr_' . $ao->getId() . '.png';

        $writer->write($qrCode)->saveToFile($tempPath);

        // Positionnement dans le coin en bas à droite avec marge
        $pdf->Image($tempPath, 170, $yPos, 25, 25, 'PNG');

        unlink($tempPath);

        // On met à jour la position Y pour le footer
        $pdf->SetY($yPos + 30);
    }

    private function addModernFooter(TCPDF $pdf, User $user): void
    {
        // Positionnement dynamique en bas de page
        $currentY = $pdf->GetY();
        $pageHeight = $pdf->getPageHeight();
        $footerY = max($currentY, $pageHeight - 40); // 20mm from bottom

        $pdf->SetY($footerY);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->SetTextColor(120, 120, 120);

        // Ligne de séparation seulement si assez d'espace
        if ($footerY < $pageHeight - 15) {
            $pdf->SetDrawColor(200, 200, 200);
            $pdf->Line(20, $footerY, 190, $footerY);
            $pdf->Ln(2);
        }

        // Texte de pied de page compact
        $footerText = sprintf(
            "Généré le %s par %s | %s | %s",
            date('d/m/Y H:i'),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPhoneNumber()
        );

        $pdf->Cell(0, 4, $footerText, 0, 1, 'C');
    }
}