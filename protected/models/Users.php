<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $created
 * @property integer $status
 * @property integer $role
 * @property integer $ban
 */
class Users extends CActiveRecord
{

	const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
	public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password', 'required'),
			array('email', 'email'),
			array('username', 'match', 'pattern'=>'/^([A-Za-z0-9 ])+$/u', 'message'=>'Допустимые символы: A-Za-z0-9 .'),
			array('created, status, role, ban', 'numerical', 'integerOnly'=>true),
			array('username, email, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, password, created, status, role, ban', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'registration'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Имя',
			'email' => 'E-mail',
			'password' => 'Пароль',
			'created' => 'Зарегистрирован',
			'status' => 'Статус',
			'role' => 'Роль',
			'ban' => 'Бан',
			'verifyCode'=> 'Код с картинки',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('status',$this->status);
		$criteria->compare('role',$this->role);
		$criteria->compare('ban',$this->ban);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
		public function hashPassword( $password )
	{
		return base64_encode(pack('H*', sha1((trim($password)))));
	}
	protected function beforeSave()
	{
		if($this->isNewRecord) {$this->created = time(); $this->role = 1;}
	    // hash password on before saving the record:
		$this->password = $this->hashPassword( $this->password );
		return parent::beforeSave();
	}
	
			public static function all() 
	{
		return Chtml::listData(self::model()->findAll(), 'id', 'username');  // хелпер вместо foreach
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
