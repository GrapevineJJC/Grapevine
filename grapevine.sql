SELECT e.EventName, e.LocationAddress, e.Description, e.EventID
FROM wp_grape_users AS u
JOIN wp_grape_user_tags AS ut ON u.ID = ut.userID
JOIN wp_grape_event_tags AS et ON ut.tagID = et.tag_id
JOIN wp_grape_events AS e ON e.EventID = et.event_id
WHERE u.ID =1