<?php

namespace App\Console\Commands;

use App\Models\Personal_Access_Token;
use Illuminate\Console\Command;

class CleanJWT extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:cleanjwt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove authentication tokens from users with the renmember_token set to false';

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
     * @return int
     */
    public function handle()
    {
        $tokens = Personal_Access_Token::with('user')->get();
        $n = 0;
        foreach ($tokens as &$token){
            if($token->user->remember_token != 'true'){
                Personal_Access_Token::where('id', $token->id)->delete();
                $n++;
            }
        }

        $this->info('JWT clean up job.'. $n .' records were affected.\n');

    }
}
