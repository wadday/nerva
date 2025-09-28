declare namespace App.Data {
export type LiveChatData = {
id: number;
user_id: number;
username: string;
message: string;
track_id: number;
stream_id: number;
sent_at: string;
is_flagged: boolean;
is_deleted: boolean;
ip_address: string | null;
metadata: Array<any> | null;
gift_type: string | null;
gift_value: number | null;
reaction_type: string | null;
created_at: string | null;
updated_at: string | null;
};
export type SongData = {
id: number;
slug: string;
title: string;
cover: string;
duration: string;
song_url: string;
status: string;
play_count: number;
};
export type StreamData = {
id: number;
title: string;
host_id: number;
started_at: string;
ended_at: string;
is_live: boolean;
audience_count: number;
engagement_rate: number;
retention_rate: number;
metadata: Array<any> | null;
created_at: string | null;
updated_at: string | null;
};
}
declare namespace App.Enums {
export type StreamerLevel = 'bronze' | 'silver' | 'gold' | 'platinum';
}
