<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage blog
 * @copyright 2001-2012 Bitrix
 */
namespace Bitrix\Blog\Integration\Socialnetwork;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Blog\Item\Post;
use Bitrix\Socialnetwork\Item\LogIndex;

class Log
{
	const EVENT_ID_POST = 'blog_post';
	const EVENT_ID_POST_IMPORTANT = 'blog_post_important';

	/**
	 * Returns set EVENT_ID processed by handler to generate content for full index.
	 *
	 * @param void
	 * @return array
	 */
	public static function getEventIdList()
	{
		return array(
			self::EVENT_ID_POST,
			self::EVENT_ID_POST_IMPORTANT
		);
	}

	/**
	 * Returns content for LogIndex.
	 *
	 * @param Event $event Event from LogIndex::setIndex().
	 * @return EventResult
	 */
	public static function onIndexGetContent(Event $event)
	{
		$result = new EventResult(
			EventResult::UNDEFINED,
			array(),
			'blog'
		);

		$eventId = $event->getParameter('eventId');
		$sourceId = $event->getParameter('sourceId');

		if (!in_array($eventId, self::getEventIdList()))
		{
			return $result;
		}

		$content = "";
		$post = false;

		if (intval($sourceId) > 0)
		{
			$post = Post::getById($sourceId);
		}

		if ($post)
		{
			$postFieldList = $post->getFields();

			$content .= LogIndex::getUserName($postFieldList["AUTHOR_ID"])." ";
			if (
				$postFieldList["MICRO"] != "Y"
				&& !empty($postFieldList["TITLE"])
			)
			{
				$content .= \blogTextParser::killAllTags($postFieldList["TITLE"])." ";
			}
			$content .= \blogTextParser::killAllTags($postFieldList["DETAIL_TEXT"]);

			$destinationsList = array();
			$res = \CBlogPost::getSocNetPerms($sourceId);
			foreach($res as $group => $list)
			{
				foreach($list as $key => $valuesList)
				{
					$destinationsList = array_merge($destinationsList, $valuesList);
				}
			}

			if (!empty($destinationsList))
			{
				$content .= ' '.join(' ', LogIndex::getEntitiesName($destinationsList));
			}

			if (!empty($postFieldList['UF_BLOG_POST_FILE']))
			{
				$fileNameList = LogIndex::getDiskUFFileNameList($postFieldList['UF_BLOG_POST_FILE']);
				if (!empty($fileNameList))
				{
					$content .= ' '.join(' ', $fileNameList);
				}
			}

			if (!empty($postFieldList['CATEGORY_ID']))
			{
				$categoryList = explode(",", $postFieldList["CATEGORY_ID"]);
				$tagList = array();
				foreach($categoryList as $value)
				{
					$category = \CBlogCategory::getByID($value);
					$tagList[] = $category["NAME"];
				}
				if (!empty($tagList))
				{
					$content .= ' '.join(' ', $tagList);
				}
			}
		}

		$result = new EventResult(
			EventResult::SUCCESS,
			array(
				'content' => $content,
			),
			'blog'
		);

		return $result;
	}
}

