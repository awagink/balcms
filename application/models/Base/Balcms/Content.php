<?php

/**
 * Base_Balcms_Content
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property string $tagline
 * @property string $description
 * @property string $description_rendered
 * @property bool $description_auto
 * @property string $tags
 * @property string $content
 * @property string $content_rendered
 * @property integer $avatar_id
 * @property integer $route_id
 * @property integer $parent_id
 * @property integer $position
 * @property enum $type
 * @property decimal $product_cost
 * @property boolean $product_taxable
 * @property integer $product_stock
 * @property string $book_isbn
 * @property string $book_isn
 * @property string $book_author
 * @property timestamp $book_published
 * @property string $book_publisher
 * @property enum $book_binding
 * @property string $book_edition
 * @property enum $book_quality
 * @property timestamp $event_start_at
 * @property timestamp $event_finish_at
 * @property Media $Avatar
 * @property Route $Route
 * @property Content $Parent
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class Base_Balcms_Content extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('balcms__content');
        $this->hasColumn('id', 'integer', 2, array(
             'primary' => true,
             'type' => 'integer',
             'unsigned' => true,
             'autoincrement' => true,
             'length' => '2',
             ));
        $this->hasColumn('code', 'string', 30, array(
             'type' => 'string',
             'notblank' => true,
             'unique' => true,
             'length' => '30',
             ));
        $this->hasColumn('title', 'string', 50, array(
             'type' => 'string',
             'notblank' => true,
             'length' => '50',
             ));
        $this->hasColumn('tagline', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('description_rendered', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('description_auto', 'bool', null, array(
             'type' => 'bool',
             'notnull' => true,
             ));
        $this->hasColumn('tags', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('content', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('content_rendered', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('avatar_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '2',
             ));
        $this->hasColumn('route_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'unique' => true,
             'length' => '2',
             ));
        $this->hasColumn('parent_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '2',
             ));
        $this->hasColumn('position', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'default' => 0,
             'length' => '2',
             ));
        $this->hasColumn('type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'content',
              1 => 'event',
             ),
             'default' => 'content',
             'notblank' => true,
             ));
        $this->hasColumn('product_cost', 'decimal', 8, array(
             'type' => 'decimal',
             'scale' => 2,
             'extra' => 
             array(
              'currency' => true,
             ),
             'length' => '8',
             ));
        $this->hasColumn('product_taxable', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             ));
        $this->hasColumn('product_stock', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '2',
             ));
        $this->hasColumn('book_isbn', 'string', 13, array(
             'type' => 'string',
             'length' => '13',
             ));
        $this->hasColumn('book_isn', 'string', 8, array(
             'type' => 'string',
             'length' => '8',
             ));
        $this->hasColumn('book_author', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('book_published', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('book_publisher', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('book_binding', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'hardcover',
              1 => 'softcover',
             ),
             ));
        $this->hasColumn('book_edition', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
        $this->hasColumn('book_quality', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'used',
              1 => 'new',
              2 => 'good',
             ),
             ));
        $this->hasColumn('event_start_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('event_finish_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));

        $this->setSubClasses(array(
             'Balcms_ContentProduct' => 
             array(
              'type' => 'product',
             ),
             'Balcms_ContentBook' => 
             array(
              'type' => 'book',
             ),
             'Balcms_ContentEvent' => 
             array(
              'type' => 'event',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Media as Avatar', array(
             'local' => 'avatar_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Route', array(
             'local' => 'route_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Content as Parent', array(
             'local' => 'parent_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $bal_doctrine_template_auditable0 = new Bal_Doctrine_Template_Auditable(array(
             'status' => 
             array(
              'disabled' => false,
             ),
             'Author' => 
             array(
              'disabled' => false,
             ),
             'authorstr' => 
             array(
              'disabled' => false,
             ),
             'created_at' => 
             array(
              'disabled' => false,
             ),
             'updated_at' => 
             array(
              'disabled' => false,
             ),
             'published_at' => 
             array(
              'disabled' => false,
             ),
             ));
        $searchable0 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'code',
              1 => 'tags',
              2 => 'authorstr',
              3 => 'title',
              4 => 'description',
             ),
             ));
        $taggable0 = new Doctrine_Template_Taggable(array(
             'tagAlias' => 'ContentTags',
             ));
        $this->actAs($softdelete0);
        $this->actAs($bal_doctrine_template_auditable0);
        $this->actAs($searchable0);
        $this->actAs($taggable0);
    }
}