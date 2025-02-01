<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly financial report';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $report = $reportService->generateMonthlyReport();

        $this->table(
            ['Total Income', 'Total Expenses', 'Net Balance', 'Savings'],
            [[
                $report['total_income'],
                $report['total_expenses'],
                $report['net_balance'],
                $report['savings']
            ]]
        );

        $this->info('Monthly report generated successfully!');
    }
}
