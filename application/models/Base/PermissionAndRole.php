<?php

/**
 * Base_PermissionAndRole
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $role_id
 * @property integer $permission_id
 * @property Role $Role
 * @property Permission $Permission
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class Base_PermissionAndRole extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('permission_and_role');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'unsigned' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('role_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'length' => '2',
             ));
        $this->hasColumn('permission_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'length' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Role', array(
             'local' => 'role_id',
             'foreign' => 'id'));

        $this->hasOne('Permission', array(
             'local' => 'permission_id',
             'foreign' => 'id'));
    }
}