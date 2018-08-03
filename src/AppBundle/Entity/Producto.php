<?php

namespace AppBundle\Entity;

/**
 * Producto
 */
class Producto
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $precioventa;

    /**
     * @var integer
     */
    private $preciocompra;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Categoria
     */
    private $idcategoria;


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set precioventa
     *
     * @param integer $precioventa
     *
     * @return Producto
     */
    public function setPrecioventa($precioventa)
    {
        $this->precioventa = $precioventa;

        return $this;
    }

    /**
     * Get precioventa
     *
     * @return integer
     */
    public function getPrecioventa()
    {
        return $this->precioventa;
    }

    /**
     * Set preciocompra
     *
     * @param integer $preciocompra
     *
     * @return Producto
     */
    public function setPreciocompra($preciocompra)
    {
        $this->preciocompra = $preciocompra;

        return $this;
    }

    /**
     * Get preciocompra
     *
     * @return integer
     */
    public function getPreciocompra()
    {
        return $this->preciocompra;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idcategoria
     *
     * @param \AppBundle\Entity\Categoria $idcategoria
     *
     * @return Producto
     */
    
    public function setIdcategoria(\AppBundle\Entity\Categoria $idcategoria = null)
    {
       $this->idcategoria = $idcategoria;

        return $this;
    }
    


    /**
     * Get idcategoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }
}

