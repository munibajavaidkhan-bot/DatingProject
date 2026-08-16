<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class JourneyController extends Controller
{
    public function index()
    {
        $phases = [
            [
                'title'  => 'Phase 1 · Know Yourself',
                'weeks'  => 'Weeks 1–12',
                'cat'    => 'self_discovery',
                'points' => [
                    'Your attachment style and how you love',
                    'Your core values and non-negotiables',
                    'Recognising patterns from past relationships',
                    'Healing what holds you back',
                ],
            ],
            [
                'title'  => 'Phase 2 · Communicate & Connect',
                'weeks'  => 'Weeks 13–24',
                'cat'    => 'communication',
                'points' => [
                    'Emotional intelligence & active listening',
                    'Vulnerability and building trust',
                    'Speaking up without fear',
                    'Dating with intention and clarity',
                ],
            ],
            [
                'title'  => 'Phase 3 · Build Deep Intimacy',
                'weeks'  => 'Weeks 25–36',
                'cat'    => 'intimacy',
                'points' => [
                    'Healthy conflict — turning fights into growth',
                    'Emotional & physical intimacy that lasts',
                    'Appreciation and daily connection rituals',
                    'Trust, loyalty and keeping the spark alive',
                ],
            ],
            [
                'title'  => 'Phase 4 · Create Your Future',
                'weeks'  => 'Weeks 37–52',
                'cat'    => 'future_planning',
                'points' => [
                    'Shared values, money & family planning',
                    'Vision-building as a couple',
                    'Growing together, not apart',
                    'Commitment and lasting partnership',
                ],
            ],
        ];

        return view('journey', compact('phases'));
    }
}