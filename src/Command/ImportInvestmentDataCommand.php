<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Investment;

#[AsCommand(
    name: 'app:import-investment-data',
    description: "Import investments' data from a JSON file into the database",
)]
class ImportInvestmentDataCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Imports investments from a JSON file into the database');
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = __DIR__ . '/../../data/dataset.json';

        if (!file_exists($filePath)) {
            $io->error("File not found: $filePath");
            return Command::FAILURE;
        }

        $jsonData = json_decode(file_get_contents($filePath), true);

        if ($jsonData === null) {
            $io->error('Invalid JSON format.');
            return Command::FAILURE;
        }

        // Iterate over each JSON object and map to the Investment entity
        foreach ($jsonData as $data) {
            $investment = new Investment();
            $investment->setTitreoperation($data['titreoperation'] ?? '-');
            $investment->setEntreprise($data['entreprise'] ?? '-');
            $anneeLivraison = !empty($data['annee_de_livraison'])
                ? \DateTime::createFromFormat('Y', $data['annee_de_livraison'])
                : null;
            $investment->setAnnee($anneeLivraison ?? null);
            $investment->setVille($data['ville'] ?? '-');
            $investment->setMandataire($data['mandataire'] ?? '-');
            $investment->setPpi($data['ppi'] ?? '-');
            $investment->setLycee($data['lycee'] ?? '-');
            $notificationDate = !empty($data['notification_du_marche'])
                ? \DateTime::createFromFormat('Y-m-d', $data['notification_du_marche'])
                : null;
            $investment->setNotification($notificationDate);
            $investment->setCodeuai($data['codeuai'] ?? '-');
            $investment->setLongitude(
                isset($data['longitude']) && is_numeric($data['longitude'])
                    ? (float) $data['longitude']
                    : 0.0
            );
            $investment->setEtatAvancement($data['etat_d_avancement'] ?? '-');
            $investment->setMontantVotes(
                isset($data['montant_des_ap_votes_en_meu']) && is_numeric($data['montant_des_ap_votes_en_meu'])
                    ? (float) $data['montant_des_ap_votes_en_meu']
                    : 0.0
            );
            $caoAttribution = !empty($data['cao_attribution'])
                ? \DateTime::createFromFormat('Y-m-d', $data['cao_attribution'])
                : null;
            $investment->setCao($caoAttribution ?? null);
            $investment->setLatitude(
                isset($data['latitude']) && is_numeric($data['latitude'])
                    ? (float) $data['latitude']
                    : 0.0
            );
            $investment->setMaitrise($data['maitrise_d_oeuvre'] ?? '-');
            $investment->setModeDevolution($data['mode_de_devolution'] ?? '-');
            $investment->setAneeIndividualisation($data['annee_d_individualisation'] ?? 0);
            $investment->setEnveloppePrev($data['enveloppe_prev_en_meu'] ?? null);

            $this->entityManager->persist($investment);
        }

        $this->entityManager->flush();

        $io->success('Investments imported successfully.');

        return Command::SUCCESS;
    }
}
