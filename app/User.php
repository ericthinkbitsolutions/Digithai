<?php

namespace App;

use App\Filters\UserFilters;
use App\Traits\UserGrowsheetAndCoachees;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Storage;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $nickname
 * @property string $email
 * @property string $password
 * @property int|null $supervisor_id
 * @property int|null $role_id
 * @property int|null $tester_role_id
 * @property int|null $role_type
 * @property int|null $expedition_id
 * @property int|null $level_id
 * @property string $gender
 * @property string|null $channel
 * @property int $points
 * @property string|null $region
 * @property string|null $job_title
 * @property mixed $is_active
 * @property int $is_refresh_maps
 * @property int $is_tester
 * @property mixed $is_admin
 * @property mixed $is_coach
 * @property mixed $is_required_in_ppe
 * @property mixed $is_coachee
 * @property int $status
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $photo_alt
 * @property string $photo_extension
 * @property string|null $google_photo_url
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int $region_id
 * @property int|null $channel_id
 * @property int|null $department_id
 * @property string|null $employee_id
 * @property int $is_onboarding
 * @property int $is_logged_in
 * @property int $terms_and_conditions
 * @property mixed $is_privacy_consent
 * @property string|null $banner_name
 * @property string|null $device_id
 * @property int $is_fcm
 * @property string|null $deleted_at
 * @property int $is_cascade
 * @property string|null $interest_ids
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CoachCoachee[] $activeCoachees
 * @property-read \App\SoarHighScore $allTimeSoarHigh
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TagRequest[] $asCoacheePendingAndApprovedUntagRequests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TagRequest[] $asCoacheePendingTagRequests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Badge[] $badges
 * @property-read \App\CascadeMonthlyFeedback $cascadeMonthlyFeedback
 * @property-read \App\Channel $channelUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $coach
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $coachGrowsheets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CoachCoacheeLog[] $coachLogs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $coacheeGrowsheets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GrowsheetOption[] $coacheeWayforwards
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CoachCoachee[] $coachees
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CompletedActivity[] $completedActivities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CompletedActivity[] $completedActivityPass
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserExpeditionActivity[] $completedExpeditionActivityCompleted
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CascadeFolder[] $customFolders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DailyActiveUser[] $dailyActiveUser
 * @property-read \App\Department|null $department
 * @property-read \App\Expedition|null $expedition
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserExpeditionActivity[] $expeditionActivities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserExpeditionActivity[] $expeditionActivitiesApproved
 * @property-read mixed $has_growsheet
 * @property-read string $photo_default
 * @property-read bool $photo_name
 * @property-read string $photo_path
 * @property-read string $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GroupUser[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $growsheetQ1
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $growsheetQ2
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $growsheetQ3
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $growsheetQ4
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $growsheets
 * @property-read \App\Level|null $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CompetencyLevel[] $levelCompetencies
 * @property-read \App\CompetencyLevel $levelCompetency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Growsheet[] $pendingGrowsheets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserPerformanceReport[] $performanceReports
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read \App\Region $regionUser
 * @property-read \App\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RoleCompetency[] $roleCompetencies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RoleExpedition[] $roleExpeditions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RoleHistory[] $roleHistories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SessionTime[] $sessionTime
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserSetting[] $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Social[] $socials
 * @property-read \App\User|null $supervisor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $tagAndPendingCoach
 * @property-read \App\Role|null $testerRole
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TrainingHour[] $trainingHours
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserBaseCampActivity[] $userBaseCampActivity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserExpeditionActivity[] $userExpeditionActivity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserNotification[] $userNotificationsUnread
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserPoint[] $userPoints
 * @property-read \App\Channel|null $usersChannel
 * @property-read \App\Region $usersRegion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User filter(\App\Filters\UserFilters $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBannerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereExpeditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGooglePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInterestIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsCascade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsCoach($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsCoachee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsFcm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsLoggedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsOnboarding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsPrivacyConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsRefreshMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsRequiredInPpe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsTester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhotoAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhotoExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTermsAndConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTesterRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User withCompletedGrowsheetPerQuarter($year, $coach)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User withFilter($request)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    public const PATH_PREFIX = 'public/users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
