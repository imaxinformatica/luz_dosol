<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    protected $table = 'premiums';

    protected $fillable = [
        'name',
        'file',
        'graduation'
    ];

    public function getGraduation()
    {
        switch ($this->graduation) {
            case 'platinum':
                $graduation = 'Platina';
                break;
            case 'diamond':
                $graduation = 'Diamante';

                break;
            case 'master':
                $graduation = 'Mestre';

                break;
            case 'emperor':
                $graduation = 'Imperador/Imperatriz';

                break;
            case 'prince':
                $graduation = 'Príncipe/Princesa';

                break;
            case 'king':
                $graduation = 'Rei/Rainha';
                break;
            default:
                $graduation = 'Sem graduação';
                break;
        }
        return $graduation;
    }
}
