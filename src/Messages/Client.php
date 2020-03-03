<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Messages;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 发送企业消息
     *
     * @return mixed
     */
    public function send($agentId, $toUsers, $toDepartments, Message $message)
    {
        if (is_array($toUsers)) {
            $toUsers = implode('|', $toUsers);
        }

        if (is_array($toDepartments)) {
            $toDepartments = implode('|', $toDepartments);
        }

        $body = array_merge($message->toArray(), [
            'agentid' => $agentId,
            'touser'  => $toUsers,
            'toparty' => $toDepartments,
        ]);

        return $this->client->postJson('message/send', $body);
    }
}
