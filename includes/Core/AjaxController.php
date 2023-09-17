<?php

namespace AwesomeCoder\School\Core;

class AjaxController
{

    /**
     * Handle the login.
     *
     * @since    1.0.0
     */
    public function login()
    {
        try {
            $user = null;
            if (!is_wp_error($user)) {
                return school_response([
                    "message" => __("You have successfully logged in.", "school"),
                ]);
            } else {
                return school_response([
                    "success" => false,
                    "message" => __('Unacceptable Entries.', 'school'),
                    // "errors"  => [$user->get_error_message()]
                ], 422);
            }
        } catch (\Exception $e) {
            return school_response([
                "success" => false,
                "message" => $e->getMessage(),
            ], 405);
        }
    }
}
