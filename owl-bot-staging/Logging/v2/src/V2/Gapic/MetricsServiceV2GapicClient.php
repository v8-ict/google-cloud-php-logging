<?php
/*
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/google/logging/v2/logging_metrics.proto
 * Updates to the above are reflected here through a refresh process.
 */

namespace Google\Cloud\Logging\V2\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;

use Google\ApiCore\PathTemplate;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Logging\V2\CreateLogMetricRequest;
use Google\Cloud\Logging\V2\DeleteLogMetricRequest;
use Google\Cloud\Logging\V2\GetLogMetricRequest;
use Google\Cloud\Logging\V2\ListLogMetricsRequest;
use Google\Cloud\Logging\V2\ListLogMetricsResponse;
use Google\Cloud\Logging\V2\LogMetric;
use Google\Cloud\Logging\V2\UpdateLogMetricRequest;
use Google\Protobuf\GPBEmpty;

/**
 * Service Description: Service for configuring logs-based metrics.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $metricsServiceV2Client = new MetricsServiceV2Client();
 * try {
 *     $formattedParent = $metricsServiceV2Client->projectName('[PROJECT]');
 *     $metric = new LogMetric();
 *     $response = $metricsServiceV2Client->createLogMetric($formattedParent, $metric);
 * } finally {
 *     $metricsServiceV2Client->close();
 * }
 * ```
 *
 * Many parameters require resource names to be formatted in a particular way. To
 * assist with these names, this class includes a format method for each type of
 * name, and additionally a parseName method to extract the individual identifiers
 * contained within formatted names that are returned by the API.
 */
class MetricsServiceV2GapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.logging.v2.MetricsServiceV2';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'logging.googleapis.com';

    /**
     * The default port of the service.
     */
    const DEFAULT_SERVICE_PORT = 443;

    /**
     * The name of the code generator, to be included in the agent header.
     */
    const CODEGEN_NAME = 'gapic';

    /**
     * The default scopes required by the service.
     */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
        'https://www.googleapis.com/auth/cloud-platform.read-only',
        'https://www.googleapis.com/auth/logging.admin',
        'https://www.googleapis.com/auth/logging.read',
        'https://www.googleapis.com/auth/logging.write',
    ];

    private static $logMetricNameTemplate;

    private static $projectNameTemplate;

    private static $pathTemplateMap;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/metrics_service_v2_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/metrics_service_v2_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/metrics_service_v2_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/metrics_service_v2_rest_client_config.php',
                ],
            ],
        ];
    }

    private static function getLogMetricNameTemplate()
    {
        if (self::$logMetricNameTemplate == null) {
            self::$logMetricNameTemplate = new PathTemplate('projects/{project}/metrics/{metric}');
        }

        return self::$logMetricNameTemplate;
    }

    private static function getProjectNameTemplate()
    {
        if (self::$projectNameTemplate == null) {
            self::$projectNameTemplate = new PathTemplate('projects/{project}');
        }

        return self::$projectNameTemplate;
    }

    private static function getPathTemplateMap()
    {
        if (self::$pathTemplateMap == null) {
            self::$pathTemplateMap = [
                'logMetric' => self::getLogMetricNameTemplate(),
                'project' => self::getProjectNameTemplate(),
            ];
        }

        return self::$pathTemplateMap;
    }

    /**
     * Formats a string containing the fully-qualified path to represent a log_metric
     * resource.
     *
     * @param string $project
     * @param string $metric
     *
     * @return string The formatted log_metric resource.
     */
    public static function logMetricName($project, $metric)
    {
        return self::getLogMetricNameTemplate()->render([
            'project' => $project,
            'metric' => $metric,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent a project
     * resource.
     *
     * @param string $project
     *
     * @return string The formatted project resource.
     */
    public static function projectName($project)
    {
        return self::getProjectNameTemplate()->render([
            'project' => $project,
        ]);
    }

    /**
     * Parses a formatted name string and returns an associative array of the components in the name.
     * The following name formats are supported:
     * Template: Pattern
     * - logMetric: projects/{project}/metrics/{metric}
     * - project: projects/{project}
     *
     * The optional $template argument can be supplied to specify a particular pattern,
     * and must match one of the templates listed above. If no $template argument is
     * provided, or if the $template argument does not match one of the templates
     * listed, then parseName will check each of the supported templates, and return
     * the first match.
     *
     * @param string $formattedName The formatted name string
     * @param string $template      Optional name of template to match
     *
     * @return array An associative array from name component IDs to component values.
     *
     * @throws ValidationException If $formattedName could not be matched.
     */
    public static function parseName($formattedName, $template = null)
    {
        $templateMap = self::getPathTemplateMap();
        if ($template) {
            if (!isset($templateMap[$template])) {
                throw new ValidationException("Template name $template does not exist");
            }

            return $templateMap[$template]->match($formattedName);
        }

        foreach ($templateMap as $templateName => $pathTemplate) {
            try {
                return $pathTemplate->match($formattedName);
            } catch (ValidationException $ex) {
                // Swallow the exception to continue trying other path templates
            }
        }

        throw new ValidationException("Input did not match any known format. Input: $formattedName");
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'logging.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the
     *           client. For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()} .
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either
     *           a path to a JSON file, or a PHP array containing the decoded JSON data. By
     *           default this settings points to the default client config file, which is
     *           provided in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string
     *           `rest` or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already
     *           instantiated {@see \Google\ApiCore\Transport\TransportInterface} object. Note
     *           that when this object is provided, any settings in $transportConfig, and any
     *           $serviceAddress setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...],
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     *     @type callable $clientCertSource
     *           A callable which returns the client cert as a string. This can be used to
     *           provide a certificate and private key to the transport layer for mTLS.
     * }
     *
     * @throws ValidationException
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
    }

    /**
     * Creates a logs-based metric.
     *
     * Sample code:
     * ```
     * $metricsServiceV2Client = new MetricsServiceV2Client();
     * try {
     *     $formattedParent = $metricsServiceV2Client->projectName('[PROJECT]');
     *     $metric = new LogMetric();
     *     $response = $metricsServiceV2Client->createLogMetric($formattedParent, $metric);
     * } finally {
     *     $metricsServiceV2Client->close();
     * }
     * ```
     *
     * @param string    $parent       Required. The resource name of the project in which to create the metric:
     *
     *                                "projects/[PROJECT_ID]"
     *
     *                                The new metric must be provided in the request.
     * @param LogMetric $metric       Required. The new logs-based metric, which must not have an identifier that
     *                                already exists.
     * @param array     $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Logging\V2\LogMetric
     *
     * @throws ApiException if the remote call fails
     */
    public function createLogMetric($parent, $metric, array $optionalArgs = [])
    {
        $request = new CreateLogMetricRequest();
        $requestParamHeaders = [];
        $request->setParent($parent);
        $request->setMetric($metric);
        $requestParamHeaders['parent'] = $parent;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CreateLogMetric', LogMetric::class, $optionalArgs, $request)->wait();
    }

    /**
     * Deletes a logs-based metric.
     *
     * Sample code:
     * ```
     * $metricsServiceV2Client = new MetricsServiceV2Client();
     * try {
     *     $formattedMetricName = $metricsServiceV2Client->logMetricName('[PROJECT]', '[METRIC]');
     *     $metricsServiceV2Client->deleteLogMetric($formattedMetricName);
     * } finally {
     *     $metricsServiceV2Client->close();
     * }
     * ```
     *
     * @param string $metricName   Required. The resource name of the metric to delete:
     *
     *                             "projects/[PROJECT_ID]/metrics/[METRIC_ID]"
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     */
    public function deleteLogMetric($metricName, array $optionalArgs = [])
    {
        $request = new DeleteLogMetricRequest();
        $requestParamHeaders = [];
        $request->setMetricName($metricName);
        $requestParamHeaders['metric_name'] = $metricName;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DeleteLogMetric', GPBEmpty::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets a logs-based metric.
     *
     * Sample code:
     * ```
     * $metricsServiceV2Client = new MetricsServiceV2Client();
     * try {
     *     $formattedMetricName = $metricsServiceV2Client->logMetricName('[PROJECT]', '[METRIC]');
     *     $response = $metricsServiceV2Client->getLogMetric($formattedMetricName);
     * } finally {
     *     $metricsServiceV2Client->close();
     * }
     * ```
     *
     * @param string $metricName   Required. The resource name of the desired metric:
     *
     *                             "projects/[PROJECT_ID]/metrics/[METRIC_ID]"
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Logging\V2\LogMetric
     *
     * @throws ApiException if the remote call fails
     */
    public function getLogMetric($metricName, array $optionalArgs = [])
    {
        $request = new GetLogMetricRequest();
        $requestParamHeaders = [];
        $request->setMetricName($metricName);
        $requestParamHeaders['metric_name'] = $metricName;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetLogMetric', LogMetric::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists logs-based metrics.
     *
     * Sample code:
     * ```
     * $metricsServiceV2Client = new MetricsServiceV2Client();
     * try {
     *     $formattedParent = $metricsServiceV2Client->projectName('[PROJECT]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $metricsServiceV2Client->listLogMetrics($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $metricsServiceV2Client->listLogMetrics($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $metricsServiceV2Client->close();
     * }
     * ```
     *
     * @param string $parent       Required. The name of the project containing the metrics:
     *
     *                             "projects/[PROJECT_ID]"
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type string $pageToken
     *           A page token is used to specify a page of values to be returned.
     *           If no page token is specified (the default), the first page
     *           of values will be returned. Any page token used here must have
     *           been generated by a previous call to the API.
     *     @type int $pageSize
     *           The maximum number of resources contained in the underlying API
     *           response. The API may return fewer values in a page, even if
     *           there are additional values to be retrieved.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listLogMetrics($parent, array $optionalArgs = [])
    {
        $request = new ListLogMetricsRequest();
        $requestParamHeaders = [];
        $request->setParent($parent);
        $requestParamHeaders['parent'] = $parent;
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListLogMetrics', $optionalArgs, ListLogMetricsResponse::class, $request);
    }

    /**
     * Creates or updates a logs-based metric.
     *
     * Sample code:
     * ```
     * $metricsServiceV2Client = new MetricsServiceV2Client();
     * try {
     *     $formattedMetricName = $metricsServiceV2Client->logMetricName('[PROJECT]', '[METRIC]');
     *     $metric = new LogMetric();
     *     $response = $metricsServiceV2Client->updateLogMetric($formattedMetricName, $metric);
     * } finally {
     *     $metricsServiceV2Client->close();
     * }
     * ```
     *
     * @param string    $metricName   Required. The resource name of the metric to update:
     *
     *                                "projects/[PROJECT_ID]/metrics/[METRIC_ID]"
     *
     *                                The updated metric must be provided in the request and it's
     *                                `name` field must be the same as `[METRIC_ID]` If the metric
     *                                does not exist in `[PROJECT_ID]`, then a new metric is created.
     * @param LogMetric $metric       Required. The updated metric.
     * @param array     $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Logging\V2\LogMetric
     *
     * @throws ApiException if the remote call fails
     */
    public function updateLogMetric($metricName, $metric, array $optionalArgs = [])
    {
        $request = new UpdateLogMetricRequest();
        $requestParamHeaders = [];
        $request->setMetricName($metricName);
        $request->setMetric($metric);
        $requestParamHeaders['metric_name'] = $metricName;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('UpdateLogMetric', LogMetric::class, $optionalArgs, $request)->wait();
    }
}