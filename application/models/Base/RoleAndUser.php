<?php

/**
 * Base_RoleAndUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property timestamp $assigned_date
 * @property integer $assignee_user_id
 * @property integer $user_id
 * @property integer $role_id
 * @property User $Assignee
 * @property User $User
 * @property Role $Role
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class Base_RoleAndUser extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('role_and_user');
        $this->hasColumn('id', 'integer', 2, array(
             'type' => 'integer',
             'primary' => true,
             'unsigned' => true,
             'autoincrement' => true,
             'length' => '2',
             ));
        $this->hasColumn('assigned_date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => false,
             ));
        $this->hasColumn('assignee_user_id', 'integer', 2, array(
             'type' => 'integer',
             'notnull' => false,
             'unsigned' => true,
             'length' => '2',
             ));
        $this->hasColumn('user_id', 'integer', 2, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             'length' => '2',
             ));
        $this->hasColumn('role_id', 'integer', 2, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             'length' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User as Assignee', array(
             'local' => 'assignee_user_id',
             'foreign' => 'id'));

        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('Role', array(
             'local' => 'role_id',
             'foreign' => 'id'));
    }
}