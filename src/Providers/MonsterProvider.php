<?php namespace JobApis\Jobs\Client\Providers;

use JobApis\Jobs\Client\Job;

class MonsterProvider extends AbstractProvider
{
    /**
     * Returns the standardized job object
     *
     * @param array $payload
     *
     * @return \JobApis\Jobs\Client\Job
     */
    public function createJobObject($payload)
    {
        $job = new Job([
            'title' => $payload['title'],
            'name' => $payload['title'],
            'description' => $payload['description'],
            'url' => $payload['link'],
            'sourceId' => $payload['guid'],
        ]);

        $job->setDatePostedAsString($payload['pubDate']);

        // Set a location if it was set in the query
        if ($this->query && $this->query->get('where')) {
            $job->setLocation($this->query->get('where'));
        }

        return $job;
    }

    /**
     * Job response object default keys that should be set
     *
     * @return  array
     */
    public function getDefaultResponseFields()
    {
        return [
            'title',
            'link',
            'description',
            'pubDate',
            'guid'
        ];
    }

    /**
     * Get format
     *
     * @return  string Currently only 'json' and 'xml' supported
     */
    public function getFormat()
    {
        return 'xml';
    }

    /**
     * Get listings path
     *
     * @return  string
     */
    public function getListingsPath()
    {
        return 'channel.item';
    }
}
