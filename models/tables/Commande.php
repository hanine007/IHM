<?php

namespace models\tables;

class Commande{

    public int $id;
    public string $id_order;
    public int $id_user;
    public int $id_nft;
    public float $amount;
    public string $payed_at;
}