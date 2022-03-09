<?php

class ProductsModel extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $id_categorie;
    protected $id_sous_categorie;

    /**
     * Fonction construct indique la table concernée par le modele
     */
    public function __construct()
    {
        $this->table = "products";
        $this->database = DataBase::getPdo();
    }



    /**
     * Get the value of id_sous_categories
     */ 
    public function getId_sous_categorie()
    {
        return $this->id_sous_categorie;
    }

    /**
     * Set the value of id_sous_categories
     *
     * @return  self
     */ 
    public function setId_sous_categorie($id_sous_categorie)
    {
        $this->id_sous_categorie = $id_sous_categorie;

        return $this;
    }

    /**
     * Get the value of id_categories
     */ 
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categories
     *
     * @return  self
     */ 
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of id_products
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id_products
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function findAllProducts()
    {
        $this->database = DataBase::getPdo();

        $findProduct=$this->database->prepare('SELECT products.*, GROUP_CONCAT(images.url_image SEPARATOR ",") as url FROM `products` INNER JOIN images ON products.id = images.id_product GROUP BY products.id');        
        $findProduct -> execute();
        $resultProduct = $findProduct -> fetchAll();


        return($resultProduct);
    }

    public function selectProductbyId($id)
    {
        $this->database = DataBase::getPdo();

        $findProduct=$this->database->prepare('SELECT products.*, GROUP_CONCAT(images.url_image SEPARATOR ",") as url FROM `products` INNER JOIN images ON products.id = images.id_product WHERE products.id=:id');        
        $findProduct -> execute(['id' => $id]);
        $resultProduct = $findProduct -> fetchAll();

        return($resultProduct);
    }
    // public function getAllProducts()
    // {
    //     $query = $this->requete("SELECT * FROM {$this->table}");
    //     return $query->fetchAll();
    // }


    public function countProducts()
    {
        $query = $this->requete("SELECT COUNT(id) AS liste FROM {$this->table}");
        $query -> execute();
        return $query->fetchAll();
    }


    public function productsByPage($nbr_products_by_page,$debut)
    {
        $query = $this->requete("SELECT * FROM {$this->table} LIMIT $debut , $nbr_products_by_page");

        return $query->fetchAll();
    }

    public function countProductsByCategories() 
    {
        $query = $this->requete("SELECT COUNT(products.id_categorie) 
        AS liste_cat
        FROM {$this->table} 
        INNER JOIN `categories` 
        ON categories.id = products.id_categorie 
        WHERE categories.name = :nameCategorie");
        $query-> execute(['nameCategorie' => $nameCategorie]);
        return $query->fetchAll();
    }

    public function productsByCategorie($nameCategorie) 
    {
        $this->database = DataBase::getPdo();

        $findProduct = $this->database->prepare("SELECT products.*, GROUP_CONCAT(images.url_image SEPARATOR ',') as url FROM `products` 
        INNER JOIN images ON products.id = images.id_product 
        INNER JOIN categories ON products.id_categorie = categories.id
        WHERE categories.name = :nameCategorie
        GROUP BY products.id");        
        $findProduct -> execute(['nameCategorie' => $nameCategorie]);
        $resultProduct = $findProduct -> fetchAll();


        return($resultProduct);
    }
    
    

    public function productsBySousCategories($nameSousCategorie,$debut_cat )
    {
        $query = $this->database->requete("SELECT products.*, GROUP_CONCAT(images.url_image SEPARATOR ',') as url FROM `products` 
        INNER JOIN images ON products.id = images.id_product
        INNER JOIN sous_categories
        ON sous_categories.id = products.id_sous_categorie 
        WHERE sous_categories.name = :nameSousCategorie 
        LIMIT :debut_cat");
        $query->execute([
            'nameSousCategorie' => $nameSousCategorie,
            'debut_cat' => $debut_cat
        ]);
        $result = $query->fetchAll();
    }
   

   

    
}