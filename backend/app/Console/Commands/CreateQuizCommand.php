<?php

namespace App\Console\Commands;

use App\Domain\Usecases\CreateQuizUsecase;
use Illuminate\Console\Command;

class CreateQuizCommand extends Command
{
    protected $signature = 'quiz:create';

    protected $description = 'Create a new quiz interactively';

    public function __construct(
        private readonly CreateQuizUsecase $createQuizUsecase,
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $title = $this->ask('クイズのタイトルを入力してください（省略可）');
        $imageUrl = $this->ask('画像URLを入力してください');
        $correctWorldId = $this->ask('正解のワールドIDを入力してください（省略可）');

        if (empty($imageUrl)) {
            $this->error('画像URLは必須です');
            return 1;
        }

        try {
            $quiz = $this->createQuizUsecase->execute(
                title: $title ?: null,
                imageUrl: $imageUrl,
                correctWorldId: $correctWorldId ?: null,
            );

            $this->info('クイズを作成しました');
            $this->table(
                ['ID', 'タイトル', '画像URL', '正解のワールドID'],
                [[
                    $quiz->id->value(),
                    $quiz->title->value() ?? '(なし)',
                    $quiz->imageUrl->value(),
                    $quiz->correctWorldId?->value() ?? '(なし)',
                ]]
            );
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}
