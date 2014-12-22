<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-10 at 11:10:16.
 */
class EventTest extends CDbTestCase
{
	/**
	 * @var Event
	 */
	protected $object;

	public $fixtures = array(
		'event' => 'Event',
	);

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new Event;
		parent::setUp();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
	}

	/**
	 * @covers Event::model
	 */
	public function testModel()
	{
		$this->assertEquals('Event', get_class(Event::model()), 'Class name should match model.');
	}

	/**
	 * @covers Event::tableName
	 */
	public function testTableName()
	{
		$this->assertEquals('event', $this->object->tableName());
	}

	/**
	 * @covers Event::beforeSave
	 */
	public function testBeforeSave()
	{
		$event = $this->event('event1');
		$this->assertNotNull( $event->event_date );
		$event->event_date = date('Y-m-d H:i:s');
		$event->save();
		$this->assertNotEquals( '0000-00-00 00:00:00', $event->event_date );
		$this->assertNotEquals( '1900-01-01 00:00:00', $event->event_date );
	}

	/**
	 * @covers Event::defaultScope
	 * @todo	 Implement testDefaultScope().
	 */
	public function testDefaultScope()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::rules
	 * @todo	 Implement testRules().
	 */
	public function testRules()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::relations
	 * @todo	 Implement testRelations().
	 */
	public function testRelations()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::search
	 * @todo	 Implement testSearch().
	 */
	public function testSearch()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::hasIssue
	 * @todo	 Implement testHasIssue().
	 */
	public function testHasIssue()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::getIssueText
	 * @todo	 Implement testGetIssueText().
	 */
	public function testGetIssueText()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::expandIssueText
	 * @todo	 Implement testExpandIssueText().
	 */
	public function testExpandIssueText()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::getInfoText
	 * @todo	 Implement testGetInfoText().
	 */
	public function testGetInfoText()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::addIssue
	 * @todo	 Implement testAddIssue().
	 */
	public function testAddIssue()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::deleteIssue
	 * @todo	 Implement testDeleteIssue().
	 */
	public function testDeleteIssue()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::deleteIssues
	 * @todo	 Implement testDeleteIssues().
	 */
	public function testDeleteIssues()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::delete
	 * @todo	 Implement testDelete().
	 */
	public function testDelete()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::getLatestOfTypeInEpisode
	 */
	public function testGetLatestOfTypeInEpisode()
	{
		$event = $this->event('event2')->getLatestOfTypeInEpisode();
		$this->assertEquals('someinfo3', $event->info);
	}

	/**
	 * @covers Event::isLatestOfTypeInEpisode
	 * @todo	 Implement testIsLatestOfTypeInEpisode().
	 */
	public function testIsLatestOfTypeInEpisode()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	/**
	 * @covers Event::audit
	 * @todo	 Implement testAudit().
	 */
	public function testAudit()
	{
			// Remove the following lines when you implement this test.
			$this->markTestIncomplete(
				'This test has not been implemented yet.'
			);
	}

	public function testgetElements()
	{
		$et = $this->getMockBuilder('EventType')
				->disableOriginalConstructor()
				->setMethods(array('getAllElementTypes'))
				->getMock();

		$event = ComponentStubGenerator::generate('Event', array('eventType' => $et));

		$et->expects($this->once())
				->method('getAllElementTypes')
				->will($this->returnValue(array()));

		$this->assertEquals(null, $event->getElements());

		$this->markTestIncomplete('At the moment this does not test that we are actually querying the element types for the event type of the event.');
	}

	public function testHasEventImage_False()
	{
		Yii::app()->assetManager->basePath = Yii::app()->basePath."/assets";

		$event = $this->event('event1');

		$this->assertFalse($event->hasEventImage('testing2398493242'));
	}

	public function testHasEventImage_True()
	{
		Yii::app()->assetManager->basePath = Yii::app()->basePath."/assets";

		$event = $this->event('event1');

		$dirname = dirname($event->getImageDirectory()."/testing2398493242.png");
		if (!file_exists($dirname)) {
			if (!@mkdir($dirname,0755,true)) {
				$this->markTestIncomplete('Skipping due to filesystem permissions');
				return;
			}
		}

		if (!@file_put_contents($event->getImageDirectory()."/testing2398493242.png", "test")) {
			$this->markTestIncomplete('Skipping due to filesystem permissions');
			return;
		}

		$this->assertTrue($event->hasEventImage('testing2398493242'));

		@unlink($event->getImageDirectory()."/testing2398493242.png");
	}

	public function testGetPDF()
	{
		$event = $this->event('event1');

		return $this->assertEquals($event->getImageDirectory().'/event.pdf', $event->getPDF());
	}

	public function testHasPDF_Event_True()
	{
		Yii::app()->assetManager->basePath = Yii::app()->basePath."/assets";
	 
		$event = $this->event('event1');

		$dirname = dirname($event->getImageDirectory()."/event.pdf");
		if (!file_exists($dirname)) {
			if (!@mkdir($dirname,0755,true)) {
				$this->markTestIncomplete('Skipping due to filesystem permissions');
				return;
			}
		}

		if (!@file_put_contents($event->getImageDirectory()."/event.pdf", "test")) {
			$this->markTestIncomplete('Skipping due to filesystem permissions');
			return;
		}
		
		$this->assertTrue($event->hasPDF());

		@unlink($event->getImageDirectory()."/event.pdf");
	}

	public function testHasPDF_Event_False()
	{
		Yii::app()->assetManager->basePath = Yii::app()->basePath."/assets";

		$event = $this->event('event1');

		$this->assertFalse($event->hasPDF());
	}

	public function testHasPDF_Other_True()
	{
		Yii::app()->assetManager->basePath = Yii::app()->basePath."/assets";
	
		$event = $this->event('event1');

		$dirname = dirname($event->getImageDirectory()."/event_testing.pdf");
		if (!file_exists($dirname)) {
			if (!@mkdir($dirname,0755,true)) {
				$this->markTestIncomplete('Skipping due to filesystem permissions');
				return;
			}
		}

		if (!@file_put_contents($event->getImageDirectory()."/event_testing.pdf", "test")) {
			$this->markTestIncomplete('Skipping due to filesystem permissions');
			return;
		}
	 
		$this->assertTrue($event->hasPDF('testing'));

		@unlink($event->getImageDirectory()."/event_testing.pdf");
	}

	public function testHasPDF_Other_False()
	{
		Yii::app()->assetManager->basePath = Yii::app()->basePath."/assets";

		$event = $this->event('event1');

		$this->assertFalse($event->hasPDF('testing'));
	}

	public function testGetBarCodeHTML()
	{
		$event = $this->event('event1');

		$html = $event->getBarCodeHTML();

		$this->assertEquals('<div style="font-size:0;position:relative;width:68px;height:8px;">
<div style="background-color:black;width:2px;height:8px;position:absolute;left:0px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:3px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:6px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:11px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:2px;height:8px;position:absolute;left:15px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:18px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:3px;height:8px;position:absolute;left:22px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:27px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:2px;height:8px;position:absolute;left:30px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:33px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:3px;height:8px;position:absolute;left:36px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:2px;height:8px;position:absolute;left:41px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:44px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:2px;height:8px;position:absolute;left:48px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:53px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:2px;height:8px;position:absolute;left:55px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:3px;height:8px;position:absolute;left:60px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:1px;height:8px;position:absolute;left:64px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:2px;height:8px;position:absolute;left:66px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:0px;height:8px;position:absolute;left:68px;top:0px;">&nbsp;</div>
<div style="background-color:black;width:0px;height:8px;position:absolute;left:68px;top:0px;">&nbsp;</div>
</div>
', $html);
	}
}
