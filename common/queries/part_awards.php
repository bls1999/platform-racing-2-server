<?php


function ensure_awards($pdo)
{
    // select all records, they get cleared out weekly or somesuch
    $awards = part_awards_select_list($pdo);

    // give users their awards
    foreach ($awards as $row) {
        if ($row->part == 0) {
            $part = '*';
        } else {
            $part = $row->part;
        }
        $type = $row->type;
        $user_id = $row->user_id;
        try {
            award_part($pdo, $user_id, $type, $part, false);
            echo "user_id: $user_id, type: $type, part: $part \n";
        } catch (Exception $e) {
            echo "Error: $e \n";
        }
    }

    // delete older records
    part_awards_delete_old($pdo);
}


function part_awards_delete_old($pdo)
{
    $result = $pdo->exec('
        DELETE FROM part_awards
         WHERE DATE_SUB(CURDATE(), INTERVAL 1 WEEK) > dateline
    ');

    if ($result === false) {
        throw new Exception('Could not delete old part awards.');
    }

    return $result;
}


function part_awards_insert($pdo, $user_id, $type, $part)
{
    $stmt = $pdo->prepare('
        INSERT INTO part_awards
           SET user_id = :user_id,
               type = :type,
               part = :part,
               dateline = NOW()
    ');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->bindValue(':part', $part, PDO::PARAM_STR);
    $result = $stmt->execute();

    if ($result === false) {
        throw new Exception('Could not insert part award.');
    }

    return $result;
}


function part_awards_select_list($pdo)
{
    $stmt = $pdo->prepare('
        SELECT user_id, type, part
          FROM part_awards
    ');
    $result = $stmt->execute();

    if ($result === false) {
        throw new Exception('Could not fetch the list of part awards.');
    }

    $awards = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (empty($awards)) {
        return false;
    }

    return $awards;
}


function part_awards_select_by_user($pdo, $user_id)
{
    $stmt = $pdo->prepare('
        SELECT type, part
          FROM part_awards
         WHERE user_id = :user_id
    ');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result === false) {
        throw new Exception('Could not fetch the list of part awards.');
    }

    $awards = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (empty($awards)) {
        return false;
    }

    return $awards;
}
