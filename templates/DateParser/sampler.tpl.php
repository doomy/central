<table>
    <tr>
        <th>Original string</th>
        <th>Parsed</th>
        <th>Certainty</th>
    </tr>
    <<<foreach|$dates|$daterow>>>
        <tr>
            <td>$$daterow->original$$</td>
            <td>$$daterow->parsed$$</td>
            <td>$$daterow->certainty$$</td>
        </tr>
    <<</foreach>>>
</table>