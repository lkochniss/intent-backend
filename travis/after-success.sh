# codecov

if [ "${TRAVIS_PULL_REQUEST}" = "false" ] ; then
    echo "This is no pullrequest"
    exit 0;
fi

if [ ! -n $2 ] ; then
    echo "Usage: merge.sh <username> <password>"
    exit 1;
fi

git checkout develop || exit
git merge $TRAVIS_COMMIT || exit

# Get the current branch
export PAGER=cat


# Create the URL to push merge to
URL=$(git remote -v | head -n1 | cut -f2 | cut -d" " -f1)
echo "Repo url is $URL"
PUSH_URL="https://$GIT_USER:$GIT_PASS@${URL:6}"

git checkout develop || exit
git merge "$TRAVIS_COMMIT" || exit

echo "Pushing changes..." && \
git push $PUSH_URL && \
echo "Merge complete!" || \
echo "Error Occurred. Merge failed"
