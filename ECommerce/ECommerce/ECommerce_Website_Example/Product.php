<?php
class Product {
    private $productName;
    private $productCompany;
    private $productPrice;
    private $productDiscount;
    private $productDescription;
    private $productRate;
    private $productQuantity;
    private $approveState;
    private $productPicture;
    private $subId;
    private $subSubId;
    function __construct($productName, $productCompany, $productPrice, $productDiscount, $productDescription, $productRate, $productQuantity, $approveState, $productPicture, $subId, $subSubId) {
        $this->productName = $productName;
        $this->productCompany = $productCompany;
        $this->productPrice = $productPrice;
        $this->productDiscount = $productDiscount;
        $this->productDescription = $productDescription;
        $this->productRate = $productRate;
        $this->productQuantity = $productQuantity;
        $this->approveState = $approveState;
        $this->productPicture = $productPicture;
        $this->subId = $subId;
        $this->subSubId = $subSubId;
    }
   public  function getProductName() {
        return $this->productName;
    }

    function getProductCompany() {
        return $this->productCompany;
    }

    function getProductPrice() {
        return $this->productPrice;
    }

    function getProductDiscount() {
        return $this->productDiscount;
    }

    function getProductDescription() {
        return $this->productDescription;
    }

    function getProductRate() {
        return $this->productRate;
    }

    function getProductQuantity() {
        return $this->productQuantity;
    }

    function getApproveState() {
        return $this->approveState;
    }

    function getProductPicture() {
        return $this->productPicture;
    }

    function getSubId() {
        return $this->subId;
    }

    function getSubSubId() {
        return $this->subSubId;
    }


}
