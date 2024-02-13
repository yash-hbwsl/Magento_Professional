<?php

namespace Yash\Mod1\Test;

class CustomClass implements \Yash\Mod1\Api\Data\Custom
{
    public function getCustomAttribute($attributeCode)
    {
        $attributeCode = null;
        return $attributeCode;
    }

    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        return $this->setCustomAttribute($attributeCode, $attributeValue);
    }

    public function getCustomAttributes()
    {
        return null;
    }

    public function setCustomAttributes(array $attributes)
    {
        return $this->setCustomAttributes($attributes);
    }

    public function getId()
    {
        return null;
    }

    public function setId($id)
    {
        return $this->setId($id);
    }

    public function getParentId()
    {
        return null;
    }

    public function setParentId($parentId)
    {
        return $this->setParentId($parentId);
    }

    public function getName()
    {
        return null;
    }

    public function setName($name)
    {
        return $this->setName($name);
    }

    public function getIsActive()
    {
        return true;
    }

    public function setIsActive($isActive)
    {
        return $this->setIsActive($isActive);
    }

    public function getPosition()
    {
        return null;
    }

    public function setPosition($position)
    {
        return $this->setPosition($position);
    }

    public function getLevel()
    {
        return null;
    }

    public function setLevel($level)
    {
        return $this->setLevel($level);
    }

    public function getChildren()
    {
        return null;
    }

    public function getCreatedAt()
    {
        return null;
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setCreatedAt($createdAt);
    }

    public function getUpdatedAt()
    {
        return null;
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setUpdatedAt($updatedAt);
    }

    public function getPath()
    {
        return null;
    }

    public function setPath($path)
    {
        return $this->setPath($path);
    }

    public function getAvailableSortBy()
    {
        return null;
    }

    public function setAvailableSortBy($availableSortBy)
    {
        return $this->setAvailableSortBy($availableSortBy);
    }

    public function getIncludeInMenu()
    {
        return true;
    }

    public function setIncludeInMenu($includeInMenu)
    {
        return $this->setIncludeInMenu($includeInMenu);
    }

    public function getExtensionAttributes()
    {
        return null;
    }

    public function setExtensionAttributes(\Magento\Catalog\Api\Data\CategoryExtensionInterface $extensionAttributes)
    {
        return $this->setExtensionAttributes($extensionAttributes);
    }
}
