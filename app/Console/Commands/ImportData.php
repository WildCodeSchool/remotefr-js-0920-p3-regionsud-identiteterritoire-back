<?php

namespace App\Console\Commands;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

//php artisan make:migration create_communes_table


class ImportDataAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regionsud:importData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import database for commune';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $account = TumblrAccounts::where("status","active")->inRandomOrder()->first();
        // $tumblr = new TumblrTools(trim($account->url),$account->offset);
        // $result = $tumblr->getTumblrPictures();
        // if(empty($result)){
        //     $account->status = "close";
        //     $account->save();
        //     $this->line(' Pictures Scrapper : Close Mode');
        //     return;
        // }else{
        //     $account->offset = $tumblr->getNewOffset();
        //     $account->save();
        //     $i = 0;
        //     foreach ($result as $item) {
        //         TumblrPictures::create([
        //             "tumblr_account_id"=>$account->id,
        //             "url"=>$item["url"],
        //         ]);
        //         $i++;
        //     }
        //     $this->line($i.' Pictures Scrapper (New Offset : '.$account->offset.')');
        // }
    }
}
